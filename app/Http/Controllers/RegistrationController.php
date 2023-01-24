<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\DefaultResource;

class RegistrationController extends Controller
{
    public function index(Request $request){
        if($request->search){
            $data = DefaultResource::collection(
                Registration::query()
                ->with('course','department')
                ->when($request->course, function ($query, $course) {
                    $query->whereHas('course',function ($query) use ($course) {
                        $query->where('id',$course);
                    });
                })
                ->paginate($request->count)
                ->withQueryString()
            );
            return $data;
        }else{
            return inertia('Modules/Registrants/Index');
        }
    }

    public function store(Request $request)
    { 
        $res= Registration::where('id',$request->id)->delete();
        return $res;
    }
}
