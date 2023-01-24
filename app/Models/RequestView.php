<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestView extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_closed',
        'thesis_id',
        'request_id'
    ];

    public function thesis()
    {
        return $this->belongsTo('App\Models\Thesis', 'thesis_id', 'id');
    }

    public function request()
    {
        return $this->belongsTo('App\Models\Request', 'request_id', 'id');
    }
}
