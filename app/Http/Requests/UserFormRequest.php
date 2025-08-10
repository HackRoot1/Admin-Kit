<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // User table
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $this->route('id'),
            'password' => $this->isMethod('post')
                ? 'required|string|min:6'
                : 'nullable|string|min:6', // Allow null on update
            'contact_number' => 'nullable|digits_between:8,15',
            'emergency_contact_number' => 'nullable|digits_between:8,15',
            'dob' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'skills' => 'nullable|array', // if JSON array
            'skills.*' => 'nullable|string|max:50', // each skill item
            'department' => 'nullable|string|max:50',
            'profile' => 'nullable|mimes:png,jpg,jpeg',

            // Address table
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:10',
        ];
    }
}
