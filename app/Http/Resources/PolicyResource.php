<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PolicyResource extends JsonResource
{
    public function toArray($request)
    {
        $b_type = ($this->borrow_time == 'Hour') ? 'Hours' : 'Days';
        $v_type = ($this->view_time == 'Hour') ? 'Hours' : 'Days';
        return [
            'id' => $this->id,
            'description' => $this->description,
            'is_viewable' => ($this->is_viewable) ? true : false,
            'view_count' => $this->view_count,
            'view_time' => $this->view_time,
            'view' => ($this->is_viewable) ? ($this->view_count == 0) ? 'No Maximum Days' : 'Limited to '.$this->view_count.' '.$b_type : 'Not Available',
            'is_borrowable' => ($this->is_borrowable) ? true : false,
            'borrow_count' => $this->borrow_count,
            'borrow_time' => $this->borrow_time,
            'borrow' => ($this->is_borrowable) ? ($this->borrow_count == 0) ? 'No Maximum Days' : 'Limited to '.$this->borrow_count.' '.$b_type : 'Not Available',
            'department' => $this->department,
            'is_within' => $this->is_within,
            'updated_at' => $this->updated_at
        ];
    }
}
