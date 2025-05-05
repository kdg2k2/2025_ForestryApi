<?php

namespace App\Http\Requests\Document;

class StoreRequest extends BaseDocumentRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_uploader' => auth('api')->id(),
        ]);
    }

    public function rules(): array
    {
        return $this->commonRules();
    }
}
