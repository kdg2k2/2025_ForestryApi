<?php

namespace App\Http\Requests\Document;

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
            'id' => 'required|integer|exists:documents,id',
            'id_document_type' => 'required|integer|exists:document_types,id',
            'name' => 'required|string|unique:documents,name,' . $this->id,
            'issued_date' => 'nullable|date_format:Y-m-d',
            'author' => 'nullable|string',
            'path' => 'nullable|mimes:pdf',
            'allow_download' => 'nullable|in:0,1',
            'id_uploader' => 'required|integer|exists:users,id',
            'id_share' => 'nullable|integer|exists:document_shares,id',
        ];
    }
}
