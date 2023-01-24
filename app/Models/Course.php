<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany('App\Models\UserProfile', 'course_id');
    } 

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }
}
