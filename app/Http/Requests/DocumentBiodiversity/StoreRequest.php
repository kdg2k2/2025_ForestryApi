<?php

namespace App\Http\Requests\DocumentBiodiversity;

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
            'id_document' => 'required|integer|exists:documents,id',
            'id_type' => 'required|integer|exists:document_biodiversity_types,id',
        ];
    }
}
