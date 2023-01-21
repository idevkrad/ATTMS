<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'is_researcher'
    ];

    public function getFirstnameAttribute($value){
        return ucwords($value);
    }

    public function getLastnameAttribute($value){
        return ucwords($value);
    }

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucwords($value);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords($value);
    }
}
