<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            // 'id' => 'required|unique:tenants,id',
            // 'full_name' => 'required',
            // 'email'=>'required',
            //'emergency_person'=>'required',
            // 'emergency_number'=>'required',
            // 'phone_no'=>'required',
            // 'password'=>'required',

        ];
    }
}