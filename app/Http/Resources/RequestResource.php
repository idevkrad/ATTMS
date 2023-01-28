<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        if($this->start != null && $this->end != null){
            $diff = strtotime($this->end) - strtotime(now());
            $diff = abs(round($diff / 86400));
        }else{
            $diff = '';
        }

        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'status' => $this->status,
            'is_borrowed' => ($this->is_borrowed) ? 'Borrow' : 'View',
            'start' => $this->start,
            'end' => date('M d, Y g:i a', strtotime($this->end)) ,
            'name' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'course' => $this->user->profile->course->name,
            'thesis' => ($this->is_borrowed) ? $this->borrows[0]->hardbound->thesis->code : $this->view->thesis->code,
            'policy_count' => ($this->is_borrowed) ? $this->borrows[0]->hardbound->thesis->department->policy->borrow_count : $this->view->thesis->department->policy->view_count,
            'policy_time' => ($this->is_borrowed) ? $this->borrows[0]->hardbound->thesis->department->policy->borrow_time : $this->view->thesis->department->policy->view_time,
            'location_office' => ($this->is_borrowed) ? $this->borrows[0]->hardbound->office->name : '',
            'location_name' => ($this->is_borrowed) ? $this->borrows[0]->hardbound->location : '',
            'created_at' => $this->created_at,
            'diff' => $diff
        ];
    }
}
