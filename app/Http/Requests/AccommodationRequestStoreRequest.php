<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccommodationRequestStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'check_in' => ['nullable', 'date', 'after_or_equal:today', 'required_with:check_out'],
            'check_out' => ['nullable', 'date', 'after:check_in'],
            'guests' => ['required', 'integer', 'min:1', 'max:12'],
            'message' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'check_out.after' => 'La fecha de salida debe ser posterior a la fecha de ingreso.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'check_in' => $this->filled('check_in') ? $this->input('check_in') : null,
            'check_out' => $this->filled('check_out') ? $this->input('check_out') : null,
            'guests' => $this->integer('guests') ?: null,
        ]);
    }
}
