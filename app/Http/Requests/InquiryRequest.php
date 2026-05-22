<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30|regex:/^[0-9+\-\(\)\s]+$/',
            'message' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'The phone number must contain only numbers and valid phone characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'The image may not be greater than 5MB.',
        ];
    }
}