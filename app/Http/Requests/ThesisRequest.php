<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title' => 'sometimes|required|unique:theses,title,'.$this->id,
            'abstract' => 'sometimes|required|string',
            'publication' => 'sometimes|required',
            'adviser_id' => 'sometimes|required',
            'department_id' => 'sometimes|required',
            'panelists' => 'required|array|min:1',
            'researchers' => 'required|array|min:1',
            'hardbounds' => 'required_if:has_hardbound,true|array|min:1',
            'tags' => 'required|array|min:1',
            'files' => 'sometimes|required',
            'files.*' => 'mimes:pdf|max:12000'
            // 'course_id' => 'sometimes|required_if:role,Student',
            // 'course_id' => 'sometimes|required_if:role,Student',
            // 'course_id' => 'sometimes|required_if:role,Student',
        ];

        if($this->has_hardbound == 1){
            foreach($this->hardbounds as $key => $staff) {
                if ( array_key_exists('id', $staff) && $staff['id'] ) { // if have an id, means an update, so add the id to ignore
                    // $rules = array_merge($rules, ['lists.'.$key.'.name' => 'required|unique:subspecializations,name,'.$staff['id']]);
                } else {  // just check if the email it's not unique
                    $rules = array_merge($rules, ['hardbounds.'.$key.'.office_id' => 'required']);
                    $rules = array_merge($rules, ['hardbounds.'.$key.'.location' => 'required']);
                    $rules = array_merge($rules, ['hardbounds.'.$key.'.is_borrowable' => 'required']);
                }
            }
        }

        return $rules;
    }

    public function messages()
    {
        $message =  [];
        if($this->has_hardbound == 1){
            foreach($this->hardbounds as $key => $staff) {
                $message = array_merge($message, ['hardbounds.'.$key.'.office_id.required' => '(*)']);
                $message = array_merge($message, ['hardbounds.'.$key.'.location.required' => '(*)']);
                $message = array_merge($message, ['hardbounds.'.$key.'.is_borrowable.required' => '(*)']);
            }
        }

        return $message;
    }
}
