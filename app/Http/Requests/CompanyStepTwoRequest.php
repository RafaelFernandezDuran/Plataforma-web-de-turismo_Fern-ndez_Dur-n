<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyStepTwoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'region' => ['required', 'string', 'max:100'],
            'contact_person' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:40', 'max:1500'],
        ];
    }

    public function messages(): array
    {
        return [
            'address.required' => 'La dirección es obligatoria.',
            'city.required' => 'La ciudad es obligatoria.',
            'region.required' => 'La región es obligatoria.',
            'contact_person.required' => 'El nombre del contacto es obligatorio.',
            'description.required' => 'La descripción de la empresa es obligatoria.',
            'description.min' => 'La descripción debe tener al menos 40 caracteres.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
}
