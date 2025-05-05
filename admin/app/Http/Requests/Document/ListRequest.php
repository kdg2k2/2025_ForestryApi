<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
        $allow_download = null;
        if ($this->allow_download == '1')
            $allow_download = '1';
        elseif ($this->allow_download == '0')
            $allow_download = '0';

        $this->merge([
            'per_page' => $this->per_page ?? null,
            'page' => $this->page ?? null,
            'allow_download' => $allow_download,
            'is_shared' => $this->is_shared ?? null,
            'id_document_type' => $this->id_document_type ?? null,
            'id_uploader' => $this->id_uploader ?? null,
            'id_unit' => $this->id_unit ?? null,
            'issued_year' => $this->issued_year ?? null,
            'search' => $this->search ?? null,
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
            'paginate' => 'required|in:0,1',
            'per_page' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
            'allow_download' => 'nullable|in:0,1',
            'is_shared' => 'nullable|in:0,1',
            'id_document_type' => 'nullable|integer|exists:document_types,id',
            'id_uploader' => 'nullable|integer|exists:admins,id',
            'id_unit' => 'nullable|integer|exists:user_units,id',
            'issued_year' => 'nullable|integer',
            'search' => 'nullable|string',
        ];
    }
}
