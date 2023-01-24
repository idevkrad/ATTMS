<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'is_borrowed',
        'start',
        'end',
        'status_id',
        'user_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function borrows()
    {
        return $this->hasMany('App\Models\RequestBorrow', 'request_id');
    } 

    public function view()
    {
        return $this->hasOne('App\Models\RequestView', 'request_id');
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
