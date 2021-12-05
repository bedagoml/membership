<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLandLordRequest extends FormRequest
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
            
            'full_name'=>'required',
            'id'=>'required|unique:landlords',
            // 'middle_name'=>'required',
            // 'email'=>'required',
            //'phone_no'=>'required',
            // 'password'=>'required',
        ];
    }
}
