<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseDocumentRequest extends FormRequest
{
    protected function commonRules(array $extra = []): array
    {
        $rules = [
            'id_document_type' => 'required|integer|exists:document_types,id',
            'name' => 'required|string|unique:documents,name' . ($this->id ? ',' . $this->id : ''),
            'issued_date' => 'nullable|date_format:Y-m-d',
            'author' => 'nullable|string',
            'path' => request()->isMethod('post') ? 'required|mimes:pdf' : 'nullable|mimes:pdf',
            'allow_download' => 'nullable|in:0,1',
            'id_uploader' => 'required|integer|exists:users,id',
            'id_share' => 'nullable|integer|exists:document_shares,id',
            'price' => 'required|integer|min:0',
        ];

        switch ($this->id_document_type) {
            case config('documents.types.other.id'):
                $rules += [
                    'new_document_type' => 'required|array',
                    'new_document_type.name' => 'required',
                ];
                break;

            case config('documents.types.legal.id'):
                $rules += [
                    'new_document_legal' => 'required|array',
                    'new_document_legal.id_type' => 'required',
                    'new_document_legal.doc_number' => 'required',
                    'new_document_legal.validity' => 'required',
                ];

                if (data_get($this, 'new_document_legal.id_type') == config('documents.types.legal.other')) {
                    $rules += [
                        'new_document_legal_type' => 'required|array',
                        'new_document_legal_type.name' => 'required',
                    ];
                }
                break;

            case config('documents.types.scientific_publication.id'):
                $rules += [
                    'new_document_scientific_publication' => 'required|array',
                    'new_document_scientific_publication.id_type' => 'required',
                    'new_document_scientific_publication.year' => 'required',
                ];

                if (data_get($this, 'new_document_scientific_publication.id_type') == config('documents.types.scientific_publication.other')) {
                    $rules += [
                        'new_document_scientific_publication_type' => 'required|array',
                        'new_document_scientific_publication_type.name' => 'required',
                    ];
                }
                break;

            case config('documents.types.biodiversity.id'):
                $rules += [
                    'new_document_biodiversitie' => 'required|array',
                    'new_document_biodiversitie.id_type' => 'required',
                ];

                if (data_get($this, 'new_document_biodiversitie.id_type') == config('documents.types.biodiversity.other')) {
                    $rules += [
                        'new_document_biodiversitie_type' => 'required|array',
                        'new_document_biodiversitie_type.name' => 'required',
                    ];
                }
                break;
        }

        return array_merge($rules, $extra);
    }
}
