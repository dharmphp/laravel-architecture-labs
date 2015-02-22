<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'gstin' => 'nullable|string|size:15'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Customer with this email address already exists in system.',
            'phone.regex' => 'Please provide valid 10-digit mobile number.'
        ];
    }
}
