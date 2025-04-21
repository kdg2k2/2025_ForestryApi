<?php

namespace App\Http\Requests\BioNationalPark;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
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
            'id_type' => 'required|exists:bio_national_park_types,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên vườn quốc gia.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',

            'fb.url' => 'Liên kết Facebook không hợp lệ.',
            'homepage.url' => 'Trang chủ không hợp lệ.',

            'id_type.required' => 'Loại vườn quốc gia là bắt buộc.',
            'id_type.exists' => 'Loại vườn quốc gia không tồn tại.',

            'logo.file' => 'Tệp logo phải là một tệp hợp lệ.',
            'logo.mimes' => 'Logo phải có định dạng: jpg, jpeg, png, hoặc webp.',
            'logo.max' => 'Logo không được vượt quá 2MB.',

            'intro_img.file' => 'Tệp ảnh giới thiệu phải là một tệp hợp lệ.',
            'intro_img.mimes' => 'Ảnh giới thiệu phải có định dạng: jpg, jpeg, png, hoặc webp.',
            'intro_img.max' => 'Ảnh giới thiệu không được vượt quá 2MB.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Dữ liệu không chính xác',
            'errors' => $validator->errors(),
        ], 422));
    }
}
