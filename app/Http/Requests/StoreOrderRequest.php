<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_name' => ['required', 'string', 'max:255'],
            'building' => ['required', 'string', 'max:255'],
            'room_number' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'payment_method' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'student_name.required' => 'Please enter your name.',
            'building.required' => 'Please enter your building/location.',
            'room_number.required' => 'Please enter your room number.',
            'phone.required' => 'Please enter your phone number.',
        ];
    }
}