<?php

namespace App\Http\Requests\BioNationalParkType;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:bio_national_park_types,name',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên loại vườn quốc gia.',
            'name.string' => 'Tên loại vườn quốc gia phải là một chuỗi.',
            'name.max' => 'Tên loại vườn quốc gia không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên loại vườn quốc gia đã tồn tại.',
        ];
    }
}
