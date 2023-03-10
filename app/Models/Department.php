<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany('App\Models\UserProfile', 'department_id');
    } 

    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'department_id');
    } 

    public function policy()
    {
        return $this->hasOne('App\Models\Policy', 'department_id');
    } 
}
