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
        $rules = [
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

        switch ($this->id_document_type) {
            case config('documents.types.other'):
                $rules = array_merge($rules, [
                    'new_document_type' => 'required|array',
                    'new_document_type.name' => 'required',
                ]);
                break;
            case config('documents.types.legal.id'):
                $rules = array_merge($rules, [
                    'new_document_legal' => 'required|array',
                    'new_document_legal.id_type' => 'required',
                    'new_document_legal.doc_number' => 'required',
                    'new_document_legal.validity' => 'required',
                ]);

                if (isset($this->new_document_legal['id_type']))
                    if ($this->new_document_legal['id_type'] == config('documents.types.legal.other'))
                        $rules = array_merge($rules, [
                            'new_document_legal_type' => 'required|array',
                            'new_document_legal_type.name' => 'required',
                        ]);
                break;
            case config('documents.types.scientific_publication.id'):
                $rules = array_merge($rules, [
                    'new_document_scientific_publication' => 'required|array',
                    'new_document_scientific_publication.id_type' => 'required',
                    'new_document_scientific_publication.year' => 'required',
                ]);

                if (isset($this->new_document_scientific_publication['id_type']))
                    if ($this->new_document_scientific_publication['id_type'] == config('documents.types.scientific_publication.other'))
                        $rules = array_merge($rules, [
                            'new_document_scientific_publication_type' => 'required|array',
                            'new_document_scientific_publication_type.name' => 'required',
                        ]);
                break;
            case config('documents.types.biodiversity.id'):
                $rules = array_merge($rules, [
                    'new_document_biodiversitie' => 'required|array',
                    'new_document_biodiversitie.id_type' => 'required',
                ]);

                if (isset($this->new_document_biodiversitie['id_type']))
                    if ($this->new_document_biodiversitie['id_type'] == config('documents.types.biodiversity.other'))
                        $rules = array_merge($rules, [
                            'new_document_biodiversitie_type' => 'required|array',
                            'new_document_biodiversitie_type.name' => 'required',
                        ]);
                break;
            default:
                break;
        }

        return $rules;
    }
}
