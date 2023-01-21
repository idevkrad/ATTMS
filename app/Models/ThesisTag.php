<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisTag extends Model
{
    use HasFactory;

    protected $fillable = ['thesis_id','tag_id'];

    public function thesis()
    {
        return $this->belongsTo('App\Models\Theses', 'thesis_id', 'id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag', 'tag_id', 'id');
    }
}
