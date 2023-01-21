<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThesisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'code' => $this->code,  
            'title' => $this->title,  
            'abstract' => $this->abstract,  
            'publication' => $this->publication,  
            'has_hardbound' => ($this->has_hardbound) ? true : false,  
            'has_softcopy' => ($this->attachment == null) ? false : true, 
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

        ];
    }
}
