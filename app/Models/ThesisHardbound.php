<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisHardbound extends Model
{
    use HasFactory;

    protected $fillable = ['thesis_id','office_id','location','is_borrowable','is_available'];

    public function thesis()
    {
        return $this->belongsTo('App\Models\Thesis', 'thesis_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo('App\Models\Office', 'office_id', 'id');
    }
}
