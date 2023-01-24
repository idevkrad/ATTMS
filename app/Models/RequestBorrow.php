<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestBorrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'remarks',
        'is_out',
        'is_lost',
        'is_returned',
        'hardbound_id',
        'request_id'
    ];

    public function hardbound()
    {
        return $this->belongsTo('App\Models\ThesisHardbound', 'hardbound_id', 'id');
    }

    public function request()
    {
        return $this->belongsTo('App\Models\Request', 'request_id', 'id');
    }
}
