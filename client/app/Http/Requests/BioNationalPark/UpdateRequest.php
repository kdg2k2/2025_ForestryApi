<?php

namespace App\Http\Requests\BioNationalPark;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    use FailedValidation;

    public function rules(): array
    {
        return [
            'id' => 'required|exists:bio_national_parks,id',
            'name' => 'nullable|string|max:255',
            'id_type' => 'nullable|exists:bio_national_park_types,id',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'intro_img' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'fb' => 'nullable|url|max:255',
            'homepage' => 'nullable|url|max:255',
            'intro' => 'nullable|string',
            'location' => 'nullable|string',
            'his_geo' => 'nullable|string',
            'biodiversity' => 'nullable|string',
            'x' => 'nullable|numeric',
            'y' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'ID là bắt buộc.',
            'id.exists' => 'Vườn quốc gia không tồn tại.',

            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',

            'fb.url' => 'Liên kết Facebook không hợp lệ.',
            'homepage.url' => 'Trang chủ không hợp lệ.',

            'id_type.exists' => 'Loại vườn quốc gia không tồn tại.',

            'logo.file' => 'Tệp logo phải là một tệp hợp lệ.',
            'logo.mimes' => 'Logo phải có định dạng: jpg, jpeg, png, hoặc webp.',
            'logo.max' => 'Logo không được vượt quá 2MB.',

            'intro_img.file' => 'Tệp ảnh giới thiệu phải là một tệp hợp lệ.',
            'intro_img.mimes' => 'Ảnh giới thiệu phải có định dạng: jpg, jpeg, png, hoặc webp.',
            'intro_img.max' => 'Ảnh giới thiệu không được vượt quá 2MB.',
        ];
    }
}
