<?php

namespace aieapV1\Http\Requests;

use aieapV1\Http\Requests\Request;

class UpdateCourseDayRequest extends Request
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
             'course'=>'required|regex:/^[\pL\s\-]+$/u|max:45',
            'start_date' => 'required',
            'completion_date' => 'required',
            'days' => 'required',
        ];
    }
}
