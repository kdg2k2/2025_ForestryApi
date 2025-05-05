<?php

namespace App\Http\Requests\Admin;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        $this->merge([
            // Thêm các giá trị mặc định ở đây
            // 'field' => $this->field ?? 'default_value',
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
            'id' => 'required|integer|exists:admins,id',
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:admins,email,$this->id|max:255",
            'password' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'path' => 'nullable|mimes:png,jpeg,jpg|max:5120',
            'id_unit' => 'required|integer|exists:user_units,id',
        ];
    }
}
