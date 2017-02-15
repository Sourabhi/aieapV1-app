<?php

namespace aieapV1\Http\Requests;

use aieapV1\Http\Requests\Request;

class UpdateStudentEnrolmentRequestAdmin extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|max:45',
         'last_name' => 'required|regex:/^[\pL\s\-]+$/u|max:45',
         'gender'=>'required|max:45',
         'house_no'=>'required|max:45',
         'town'=>'required|max:45',
         'state'=>'required|max:45',
         'postcode'=>'required|max:20',
         'country'=>'required|max:45',
         'nationality'=>'required|alpha|max:30',
         'email' => 'required|email|unique:students,id,'.$this->id,
         'phone' => 'required|regex:/^[0]{2,}[0-9]{3,15}$/|min:12|max:15',
         'courses'=>'required|max:45',
        ];
    }
}
