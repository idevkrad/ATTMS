<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;
use App\Http\Requests\ThesisRequest;
use App\Http\Resources\ThesisResource;

class ThesisController extends Controller
{
    public function index(Request $request){
        echo phpinfo();
        if($request->search){
            $data = ThesisResource::collection(
                Thesis::query()
                ->with('status','department:id,name','user:id,username','hardbounds.office:id,name')
                ->with('panelists:thesis_id,panelist_id','panelists.name:id,firstname,lastname')
                ->with('researchers:thesis_id,researcher_id','researchers.name:id,firstname,lastname')
                ->with('adviser:thesis_id,adviser_id','adviser.name:id,firstname,lastname')
                ->with('tags:thesis_id,tag_id','tags.tag:id,name')
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
            return inertia('Modules/Theses/Index');
        }
    }

    public function store(ThesisRequest $request)
    {
        $data = \DB::transaction(function () use ($request){
            return $data = Thesis::new($request->all());
        });

        return back()->with([
            'message' => 'Thesis created successfully. Thanks',
            'data' => new ThesisResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }
}
