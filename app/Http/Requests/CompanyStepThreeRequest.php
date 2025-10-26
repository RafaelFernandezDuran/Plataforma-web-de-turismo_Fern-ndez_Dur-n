<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CompanyStepThreeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_email' => ['required', 'email', Rule::unique('users', 'email')],
            'user_password' => ['required', 'string', Password::defaults(), 'confirmed'],
            'terms_accepted' => ['required', 'accepted'],
            'privacy_accepted' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_email.required' => 'El email del usuario es obligatorio.',
            'user_email.email' => 'Ingresa un email válido.',
            'user_email.unique' => 'Ya existe un usuario con este email.',
            'user_password.required' => 'La contraseña es obligatoria.',
            'user_password.confirmed' => 'La confirmación de contraseña no coincide.',
            'terms_accepted.accepted' => 'Debe aceptar los términos y condiciones.',
            'privacy_accepted.accepted' => 'Debe aceptar la política de privacidad.',
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
