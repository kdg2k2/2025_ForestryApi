<?php

namespace App\Http\Requests\DocumentScientificPublication;

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
            'id' => 'required|integer|exists:document_scientific_publications,id',
            'id_document' => 'required|integer|exists:documents,id',
            'id_type' => 'required|integer|exists:document_scientific_publication_types,id',
            'co_author' => 'nullable|string',
            'year' => 'required|integer',
            'edition' => 'nullable|string',
            'accompanying_documents' => 'nullable|string',
            'linkyoutube' => 'nullable|string',
        ];
    }
}
