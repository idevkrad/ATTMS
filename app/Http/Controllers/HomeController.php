<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thesis;
use App\Models\Request as Req;
use App\Models\Registration;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\SearchResource;
use App\Providers\RouteServiceProvider;

class HomeController extends Controller
{
    public function index(Request $request){
        if($request->search){
            $data = SearchResource::collection(
                Thesis::query()
                ->with('status','department.policy','department:id,name','user:id,username','hardbounds.office:id,name')
                ->with('panelists:thesis_id,panelist_id','panelists.name:id,firstname,lastname')
                ->with('researchers:thesis_id,researcher_id','researchers.name:id,firstname,lastname')
                ->with('adviser:thesis_id,adviser_id','adviser.name:id,firstname,lastname')
                ->with('tags:thesis_id,tag_id','tags.tag:id,name')
                ->when($request->department, function ($query, $department) {
                    $query->whereHas('department',function ($query) use ($department) {
                        $query->where('id',$department);
                    });
                })
                ->when($request->tags, function ($query, $tags) {
                    $query->whereHas('tags',function ($query) use ($tags) {
                        $query->whereIn('id',$tags);
                    });
                })
                ->when($request->keyword, function ($query, $keyword) {
                    $query->where('code', 'LIKE', "%{$keyword}%")
                    ->orWhere('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('publication', 'LIKE', "%{$keyword}%");
                })
                ->when($request->publication, function ($query, $publication) {
                    $query->where('publication',$publication);
                })
                ->get()
            );
            return $data;
        }else{
            if(\Auth::check()){
                if(\Auth::user()->role != 'Student'){
                    if(\Auth::user()->role == 'Thesis Handler'){
                        $dept_id = \Auth::user()->profile->department_id;

                        $array = [
                            'Total Theses' => Thesis::where('department_id',$dept_id)->count(),
                            'Total Borrow Request' => Req::whereHas('user',function ($query) use ($dept_id) {
                                $query->whereHas('profile',function ($query) use ($dept_id) {
                                    $query->where('department_id',$dept_id);
                                });
                            })->whereIn('status_id',[4,5])->where('is_borrowed',1)->count(),
                            'Total View Request' => Req::whereHas('user',function ($query) use ($dept_id) {
                                $query->whereHas('profile',function ($query) use ($dept_id) {
                                    $query->where('department_id',$dept_id);
                                });
                            })->whereIn('status_id',[4,5])->where('is_borrowed',0)->count(),
                        ];

                        return inertia('Modules/Home/Handler',['counts' => $array]);
                    }else{
                        return inertia('Modules/Home/Index');
                    }
                }else{
                    return inertia('Welcome');
                }
            }else{
                return inertia('Public');
            }
        }
    }

    public function store(RegistrationRequest $request)
    { 
        $data = \DB::transaction(function () use ($request){
            return $data = Registration::create($request->all());
        });

        return back()->with([
            'message' => 'Registered successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function myrequests(Request $request){
        return inertia('Landing/Request');
    }

    public function pdf(Request $request){
        
        return inertia('Modules/PDF/Viewer',['code' => $request->foo]);
    }
}
