<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\NameRequest;
use App\Http\Resources\NameResource;

class NameController extends Controller
{
    public function index(Request $request){
        $keyword = $request->keyword;
        $is_researcher = ($request->role == 'true') ? 1 : 0;
        $data = Name::where(function($query) use ($keyword) {
                $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', "%{$keyword}%")
                ->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', "%{$keyword}%");
            })
            ->where('is_researcher',$is_researcher)
            ->get();

        return NameResource::collection($data);
    }

    public function store(NameRequest $request)
    { 
        $data = \DB::transaction(function () use ($request){
            return $data = Name::create($request->all());
        });

        return back()->with([
            'message' => 'Name created successfully. Thanks',
            'data' => new NameResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function show(Request $request){
        if($request->name == 'keywords'){
            $data = \DB::transaction(function () use ($request){
                $data = new Tag;
                $data->name = $request->word;
                $data->save();
                return $data;
            });
            return $data;
        }else if($request->name == 'search'){
            $keyword = $request->word;
            $data =  Tag::where('name','LIKE','%'.$keyword.'%')->take(5)->get();
            return $data;
        }
    }
}
