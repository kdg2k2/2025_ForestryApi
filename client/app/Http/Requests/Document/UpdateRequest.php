<?php

namespace App\Http\Requests\Document;

class UpdateRequest extends BaseDocumentRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->commonRules([
            'id' => 'required|integer|exists:documents,id',
        ]);
    }
}

