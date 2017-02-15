<?php

namespace aieapV1\Http\Requests;

use aieapV1\Http\Requests\Request;

class UpdateVisitorQueryRequest extends Request
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
        'email' => 'required|email|unique:queryvisitors,id,'.$this->id,
       /*'Phone' => 'required|regex:/^[0-9\+]{1,}[0-9\-]{3,15}$/|min:12|max:15',*/
       'phone' => 'required|regex:/^[0]{2,}[0-9]{3,15}$/|min:12|max:15',
       'nationality'=>'required|alpha|max:30',
        'message' => 'required',
            
        ];
    }
}
