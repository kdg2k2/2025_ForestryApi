<?php

namespace App\Http\Requests\BioNationalParkType;

class UpdateRequest extends CreateRequest
{
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'id' => 'required|exists:bio_national_park_types,id',
        ];
    }

    public function messages(): array
    {
        return [
            ...parent::messages(),
            'id.required' => 'ID là bắt buộc.',
            'id.exists' => 'Loại vườn quốc gia không tồn tại.',
        ];
    }
}
