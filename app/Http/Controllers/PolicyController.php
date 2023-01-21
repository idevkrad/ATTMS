<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Requests\PolicyRequest;
use App\Http\Resources\PolicyResource;

class PolicyController extends Controller
{
    public function index(Request $request){
        if($request->search){
            $data = PolicyResource::collection(
                Policy::query()
                ->with('department')
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
            return inertia('Modules/Policies/Index');
        }
    }

    public function store(PolicyRequest $request)
    { 
        $data = \DB::transaction(function () use ($request){
            return $data = Policy::create($request->all());
        });

        return back()->with([
            'message' => 'User created successfully. Thanks',
            'data' => new PolicyResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }
}
