<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        $this->merge([
            // Thêm các giá trị mặc định ở đây
            // 'field' => $this->field ?? 'default_value',
            "role_expires_in" => $this->role_expires_in ? date("Y-m-d H:i", strtotime($this->role_expires_in)) : null,
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
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$this->id|max:255",
            'password' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'path' => 'nullable|mimes:png,jpeg,jpg|max:5120',
            'id_unit' => 'required|integer|exists:user_units,id',
            'id_role' => 'required|integer|exists:user_roles,id',
            'role_expires_in' => 'nullable|date_format:Y-m-d H:i',
        ];
    }
}
