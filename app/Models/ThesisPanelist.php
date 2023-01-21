<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisPanelist extends Model
{
    use HasFactory;

    protected $fillable = ['thesis_id','panelist_id'];

    public function thesis()
    {
        return $this->belongsTo('App\Models\Theses', 'thesis_id', 'id');
    }

    public function name()
    {
        return $this->belongsTo('App\Models\Name', 'panelist_id', 'id');
    }
}
