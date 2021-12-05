<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            
           'subscription_date'=>'required|unique:subscriptions,subscription_date',
            'registration_amount'=>'required',            
            'is_admin'=>'required|unique:subscriptions,is_admin',
            //'emergency_person'=>'required',
           // 'emergency_number'=>'required',
           // 'phone_no'=>'required',
        //    'password' => 'required',
        //     'repeat-password' => 'required|same:password',
            
        ];
    }
}
