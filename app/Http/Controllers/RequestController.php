<?php

namespace App\Http\Controllers;

use App\Models\Request as Req;
use App\Models\RequestBorrow;
use App\Models\ThesisHardbound;
use Illuminate\Http\Request;
use App\Http\Resources\RequestResource;

class RequestController extends Controller
{
    public function index(Request $request){
        if($request->search){
            $data = RequestResource::collection(
                Req::query()
                ->with('status','user.profile.course')
                ->with('borrows.hardbound.thesis.department.policy','view.thesis')
                ->when($request->department, function ($query, $department) {
                    $query->whereHas('department',function ($query) use ($department) {
                        $query->where('id',$department);
                    });
                })
                ->paginate($request->count)
                ->withQueryString()
            );
            return $data;
        }else{
            return inertia('Modules/Requests/Index');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'end' => 'sometimes|required_if:type,==,unli',
            'is_out' => 'sometimes|required_if:type,!=,VIEW',
        ]);

        $data = \DB::transaction(function () use ($request){
            $year = date('Y');
            $month = date('m');
            $count = Req::count();
            $code = $request->type[0].$year.$month.str_pad(($count+1), 4, '0', STR_PAD_LEFT); 
            $is_out = ($request->venue == 'In-Campus') ? false : true;
            $type = ($request->type == 'VIEW') ? false : true;

            $data = Req::create(array_merge($request->all(),['reference' => $code,'is_borrowed' => $type,'status_id' => 2 ,'user_id' => \Auth::user()->id]));
            if($request->type == 'VIEW'){
                $data->view()->create($request->all());
            }else{
                $data->borrows()->create(array_merge($request->all(),['is_out' => $is_out]));
                $h = ThesisHardbound::where('id',$request->hardbound_id)->update(['is_available' => 0]);
            }
            return $data;
        });

        return back()->with([
            'message' => 'Request created successfully. Thanks',
            'data' => new RequestResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function update(Request $request){
        $data = \DB::transaction(function () use ($request){
            $data = Req::findOrFail($request->id);

            if($request->status == 'approve'){
                if($data->end == null){
                    $time = ($request->time == 'Day') ? ' days' : ' hours';
                    $add = $request->count.$time;
                    $end = date('Y-m-d H:i:s', strtotime($add));
                    $data->end = $end;
                }
                $data->status_id = ($request->type == 'View') ? 4 : 3;
            }else if($request->status == 'claim'){
                $data->status_id = 4;
            }else if($request->status == 'return'){
                $data->status_id = 5;

            }
            $data->start = now();
            $data->save();

            return $data;
        });

        return back()->with([
            'message' => 'Request was approved. Thanks',
            'data' => new RequestResource($data),
            'type' => 'bxs-check-circle'
        ]); 

    }

    public function show(Request $request){
        if($request->type == 'notifications'){
            $query = Req::query();
            $query->with('status','user.profile.course');
            $query->with('borrows.hardbound.thesis','borrows.hardbound.office','view.thesis');
            $query->when($request->department, function ($query, $department) {
                $query->whereHas('department',function ($query) use ($department) {
                    $query->where('id',$department);
                });
            });
            (\Auth::user()->role == 'Student') ? $query->whereIn('status_id',[3,4]) : '';
            (\Auth::user()->role != 'Student') ? $query->where('is_seen_to',0) : $query->where('is_seen_from',0);
            $data = $query->orderBy('created_at','ASC')->paginate(1)->withQueryString();

            return $data = RequestResource::collection($data);
        }else if($request->type == 'lists'){
            $query = Req::query();
            $query->with('status','user.profile.course');
            $query->with('borrows.hardbound.thesis','borrows.hardbound.office','view.thesis');
            $query->when($request->department, function ($query, $department) {
                $query->whereHas('department',function ($query) use ($department) {
                    $query->where('id',$department);
                });
            });
            $query->where('user_id',\Auth::user()->id);
            $query->whereIn('status_id',[2,3,4]);
            $data = $query->orderBy('created_at','ASC')->get();

            return $data = RequestResource::collection($data);
        }else{
            $data = Req::findOrFail($request->id);
            (\Auth::user()->role == 'Student') ? $data->is_seen_from = 1 : $data->is_seen_to = 1;
            $data->save();

            return$data;
            // return $notification->view($request->document,$request->actions); 
        }
    }
}
