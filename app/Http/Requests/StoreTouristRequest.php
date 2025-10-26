<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreTouristRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'user_type' => ['required', Rule::in(['tourist', 'company_admin'])],
            'nationality' => ['required', 'string', 'size:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'phone.max' => 'El teléfono no debe exceder 20 caracteres.',
            'user_type.required' => 'Selecciona el tipo de usuario.',
            'user_type.in' => 'El tipo de usuario no es válido.',
            'nationality.required' => 'La nacionalidad es obligatoria.',
            'nationality.size' => 'La nacionalidad debe estar en formato ISO (3 letras).',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nationality' => $this->filled('nationality') ? strtoupper($this->input('nationality')) : null,
        ]);
    }
}
