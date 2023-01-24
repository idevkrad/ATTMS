<?php

namespace App\Models;

use App\Models\Thesis;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'abstract',
        'publication',
        'attachment',
        'has_hardbound',
        'has_cd',
        'department_id',
        'status_id',
        'user_id'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\ThesisTag', 'thesis_id');
    } 

    public function researchers()
    {
        return $this->hasMany('App\Models\ThesisResearcher', 'thesis_id');
    } 

    public function panelists()
    {
        return $this->hasMany('App\Models\ThesisPanelist', 'thesis_id');
    } 

    public function hardbounds()
    {
        return $this->hasMany('App\Models\ThesisHardbound', 'thesis_id');
    } 

    public function adviser()
    {
        return $this->hasOne('App\Models\ThesisAdviser', 'thesis_id');
    } 

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    public function scopeNew($query, $request){
        $dept_id = $request['department_id'];
        $type = Department::where('id',$dept_id)->pluck('shortcut');
        $year = date('Y');
        $month = date('m');
        $count = Thesis::where('department_id',$dept_id)->count();
		$code = $type[0]."-".$year."-".$month."-".str_pad(($count+1), 4, '0', STR_PAD_LEFT);  
        $file_path = null;
        if($request['files'])
        {
            $files =$request['files'];   
            foreach ($files as $key=>$file) {
                if($key == 0){
                    $file_name = $code.'.'.$file->getClientOriginalExtension();
                }else{
                    $file_name = $code.'-'.$key.'.'.$file->getClientOriginalExtension();
                }
                $file_path = $file->storeAs('uploads', $file_name, 'public');

                $fileinfo = pathinfo($file_name, PATHINFO_FILENAME);
            }
        }


        $thesis = $query->create(array_merge($request, ['attachment' => $file_path,'code' => $code,'status_id' => 1 ,'user_id' => \Auth::user()->id]));
        $thesis->adviser()->create($request);
     
        foreach($request['researchers'] as $researcher) {
            $thesis->researchers()->create(array_merge($request, ['researcher_id' => $researcher]));
        }
        foreach($request['panelists'] as $panel) {
            $thesis->panelists()->create(array_merge($request, ['panelist_id' => $panel]));
        }
        foreach($request['tags'] as $tag) {
            $thesis->tags()->create(array_merge($request, ['tag_id' => $tag['id']]));
        }
        if($request['has_hardbound'] == 1){
            foreach($request['hardbounds'] as $book) {
                $thesis->hardbounds()->create(array_merge($request, ['office_id' => $book['office_id'], 'location' => $book['location'], 'is_borrowable' => $book['is_borrowable']]));
            }
        }

     
        return $thesis;
    }
}
