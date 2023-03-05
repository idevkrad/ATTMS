<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends FormRequest
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
        return [
            'description' => 'sometimes|required|string',
            'department_id' => 'sometimes|required|unique:policies,department_id,'.$this->id,
            'borrow_count' => 'required_if:is_borrowable,true',
            'borrow_time' => 'required_if:is_borrowable,true',
            'view_count' => 'required_if:is_viewable,true',
            'view_time' => 'required_if:is_viewable,true'
        ];
    }

    
    public function messages()
    {
        $message = [
            'borrow_count.required_if' => '*',
            'borrow_time.required_if' => '*', 
            'view_count.required_if' => '*',
            'view_time.required_if' => '*',
        ];
        return $message;
    }
}
