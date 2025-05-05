<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
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
            'id_role' => $this->id_role ?? config('user-roles.FORESTER_START.id'),
            'address' => $this->address ?? null,
            'path' => $this->path ?? null,
            'role_expires_in' => $this->role_expires_in ?? null,
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
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'path' => 'nullable|mimes:png,jpeg,jpg|max:5120',
            'id_unit' => 'required|integer|exists:user_units,id',
            'id_role' => 'required|integer|exists:user_roles,id',
            'role_expires_in' => 'nullable|date_format:Y-m-d H:i',
        ];
    }
}
