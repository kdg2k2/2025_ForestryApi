<?php

namespace App\Http\Requests\Admin;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use FailedValidation;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    public function prepareForValidation()
    {
        $this->merge([
            'id_unit' => $this->id_unit ?? config('user-units.UNDEFINED.id'),
            'address' => $this->address ?? null,
            'path' => $this->path ?? null,
        ]);
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
            'email' => 'required|email|unique:admins,email|max:255',
            'password' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'path' => 'nullable|mimes:png,jpeg,jpg|max:5120',
            'id_unit' => 'required|integer|exists:user_units,id',
        ];
    }
}
