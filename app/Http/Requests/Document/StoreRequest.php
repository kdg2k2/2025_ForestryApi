<?php

namespace App\Http\Requests\Document;

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
    protected function prepareForValidation()
    {
        $this->merge([
            'id_uploader' => auth('api')->id(),
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
            'id_document_type' => 'required|integer|exists:document_types,id',
            'name' => 'required|string|unique:documents,name',
            'issued_date' => 'nullable|date_format:Y-m-d',
            'author' => 'nullable|string',
            'path' => 'required|mimes:pdf',
            'allow_download' => 'nullable|in:0,1',
            'id_uploader' => 'required|integer|exists:users,id',
            'id_share' => 'nullable|integer|exists:document_shares,id',
        ];

        switch ($this->id_document_type) {
            case config('documents.types.khac'):
                $rules = array_merge($rules, [
                    'new_document_type' => 'required|array',
                    'new_document_type.name' => 'required',
                ]);
                break;
            case config('documents.types.van-ban-phap-ly.id'):
                $rules = array_merge($rules, [
                    'new_document_legal' => 'required|array',
                    // 'new_document_legal.id_document' => 'required',
                    'new_document_legal.id_type' => 'required',
                    'new_document_legal.doc_number' => 'required',
                    'new_document_legal.validity' => 'required',
                ]);
                break;
            case config('documents.types.an-pham-khoa-hoc.id'):
                $rules = array_merge($rules, [
                    'new_document_scientific_publication' => 'required|array',
                    // 'new_document_scientific_publication.id_document' => 'required',
                    'new_document_scientific_publication.id_type' => 'required',
                    'new_document_scientific_publication.year' => 'required',
                ]);
                break;
            case config('documents.types.da-dang-sinh-hoc.id'):
                $rules = array_merge($rules, [
                    'new_document_biodiversitie' => 'required|array',
                    // 'new_document_biodiversitie.id_document' => 'required',
                    'new_document_biodiversitie.id_type' => 'required',
                ]);
                break;
            // case config('documents.types.van-ban-phap-ly.khac'):
            //     $rules = array_merge($rules, [
            //         'new_document_legal_type' => 'required|array',
            //         'new_document_legal_type.name' => 'required',
            //     ]);
            //     break;
            // case config('documents.types.an-pham-khoa-hoc.khac'):
            //     $rules = array_merge($rules, [
            //         'new_document_scientific_publication_type' => 'required|array',
            //         'new_document_scientific_publication_type.name' => 'required',
            //     ]);
            //     break;
            // case config('documents.types.da-dang-sinh-hoc.khac'):
            //     $rules = array_merge($rules, [
            //         'new_document_biodiversity_type' => 'required|array',
            //         'new_document_biodiversity_type.name' => 'required',
            //     ]);
            //     break;
            default:
                break;
        }

        return $rules;
    }
}
