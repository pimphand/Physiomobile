<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'id_type' => 'required|string|max:50',
            'id_no' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('id_type', $this->validated('id_type'))
                        ->where('id_no', $this->validated('id_no'));
                }),
            ],
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'address' => 'required|string',
            'medium_acquisition' => 'required|string|max:255',
        ];
    }
}
