<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 
        'lastname', 
        'middlename',
        'suffix',
        'gender',
        'mobile',
        'department_id',
        'course_id',
        'status_id',
        'username',
        'email'
    ];

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucwords(strtolower($value));
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords(strtolower($value));
    }

    public function setMiddlenameAttribute($value)
    {
        $this->attributes['middlename'] = ucwords(strtolower($value));
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }
}
