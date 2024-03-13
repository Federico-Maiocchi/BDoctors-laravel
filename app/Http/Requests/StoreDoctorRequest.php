<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreDoctorRequest extends FormRequest
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
            'curriculum' => 'nullable|max:2000|min:3',
            'foto' => 'nullable|max:2000|min:3',
            'address' => 'required|max:255|min:3',
            'phone_number' => 'nullable|max:20|min:8',
            'medical_services' => 'nullable|max:300|min:3',
        ];
    }
}
