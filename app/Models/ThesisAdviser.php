<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisAdviser extends Model
{
    use HasFactory;

    protected $fillable = ['thesis_id','adviser_id'];

    public function thesis()
    {
        return $this->belongsTo('App\Models\Thesis', 'thesis_id', 'id');
    }

    public function name()
    {
        return $this->belongsTo('App\Models\Name', 'adviser_id', 'id');
    }
}
