<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class APIStoreMessageRequest extends FormRequest
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
        // Regole di validazione
        return [
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'phone_number' => 'required|max:20',
            'email' => 'required|max:255',
            'message' => 'required',
            'doctor_id' => 'required|numeric|exists:doctors,id'
        ];
    }

    // Funzione per creare la risposta nel caso in cui non si supera la validazione
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => "I dati inseriti non sono corretti!",
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
