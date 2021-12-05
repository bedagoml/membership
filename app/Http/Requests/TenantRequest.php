<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            
           'phone'=>'required|unique:tenants,phone',
            'full_name'=>'required',            
            'email'=>'required|unique:tenants,email',
            //'emergency_person'=>'required',
           // 'emergency_number'=>'required',
           // 'phone_no'=>'required',
        //    'password' => 'required',
        //     'repeat-password' => 'required|same:password',
            
        ];
    }
}
