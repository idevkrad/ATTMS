<?php

namespace App\Http\Resources;

use \App\Models\Request;
use \App\Models\ThesisHardbound;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    public function toArray($request)
    {
        $user_id = \Auth::user()->id;
        $id = $this->id;
        $view = Request::where('user_id',$user_id)->whereHas('view',function ($query) use ($id) {
            $query->where('thesis_id',$id)->whereIn('status_id',[2,3]);
        })->count();
        $borrow = ThesisHardbound::where('thesis_id',$id)->where('is_borrowable',1)->where('is_available',1)->count();
        $toborrow = ThesisHardbound::where('thesis_id',$id)->where('is_borrowable',1)->where('is_available',1)->pluck('id')->first();

        return [
            'id'=>$this->id,
            'code' => $this->code,  
            'title' => $this->title,  
            'abstract' => $this->abstract,  
            'publication' => $this->publication,  
            'has_hardbound' => ($borrow > 0) ? ($this->has_hardbound) ? true : false : false,  
            'has_softcopy' => ($view == 0) ? ($this->attachment == null) ? false : true : false, 
            'has_cd' => $this->has_cd,  
            'code' => $this->code,
            'department' => $this->department, 
            'status' => $this->status,
            'user' => $this->user->username,
            'panelists' => Name2Resource::collection($this->panelists),
            'researchers' => Name2Resource::collection($this->researchers),
            'adviser' => new Name2Resource($this->adviser),
            'tags' => TagResource::collection($this->tags),
            'hardbounds' => $this->hardbounds,
            'hardbound_id' => $toborrow,
        ];
    }
}
