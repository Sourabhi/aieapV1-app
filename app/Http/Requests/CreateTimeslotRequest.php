<?php

namespace aieapV1\Http\Requests;

use aieapV1\Http\Requests\Request;

class CreateTimeslotRequest extends Request
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
        'timeslot' => 'required|max:45|unique:timeslots,id,'.$this->id,
        'starttime' => 'required',
        'endtime'=>'required',
        ];
    }
}
