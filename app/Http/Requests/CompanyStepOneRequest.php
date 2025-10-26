<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CompanyStepOneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('companies', 'name')],
            'ruc' => ['required', 'regex:/^[0-9]{11}$/', Rule::unique('companies', 'ruc')],
            'email' => ['required', 'email', Rule::unique('companies', 'email')],
            'phone' => ['required', 'string', 'min:7', 'max:15'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre comercial es obligatorio.',
            'name.unique' => 'Ya existe una empresa con este nombre.',
            'ruc.required' => 'El RUC es obligatorio.',
            'ruc.regex' => 'El RUC debe contener exactamente 11 dígitos numéricos.',
            'ruc.unique' => 'Ya existe una empresa registrada con este RUC.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Ingresa un email válido.',
            'email.unique' => 'Ya existe una empresa con este email.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.min' => 'El teléfono debe tener al menos 7 caracteres.',
            'phone.max' => 'El teléfono no debe exceder 15 caracteres.',
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
