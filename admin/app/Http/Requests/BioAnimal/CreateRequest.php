<?php

namespace App\Http\Requests\BioAnimal;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    use FailedValidation;
    public function authorize(): bool
    {
        return true; // Cho phép mọi user thực hiện request này
    }

    public function rules(): array
    {
        return [
            'nganhlatin' => 'nullable|string|max:255',
            'nganhtv' => 'nullable|string|max:255',
            'manganh' => 'nullable|string|max:255',
            'loplatin' => 'nullable|string|max:255',
            'loptv' => 'nullable|string|max:255',
            'malop' => 'nullable|string|max:255',
            'bolatin' => 'nullable|string|max:255',
            'botv' => 'nullable|string|max:255',
            'mabo' => 'nullable|string|max:255',
            'holatin' => 'nullable|string|max:255',
            'hotv' => 'nullable|string|max:255',
            'maho' => 'nullable|string|max:255',
            'chilatin' => 'nullable|string|max:255',
            'chitv' => 'nullable|string|max:255',
            'machi' => 'nullable|string|max:255',
            'danhphap2phan' => 'nullable|string|max:255',
            'loailatin' => 'nullable|string|max:255',
            'tentacgia' => 'nullable|string|max:255',
            'loaitv' => 'nullable|string|max:255',
            'maloai' => 'nullable|string|max:255',
            'hinhthai' => 'nullable|string|max:1000',
            'sinhthai' => 'nullable|string|max:1000',
            'pbo_vietnam' => 'nullable|string|max:255',
            'pbo_thegioi' => 'nullable|string|max:255',
            'dachuu' => 'nullable|string|max:255',
            'giatri' => 'nullable|string|max:1000',
            'sachdovn' => 'nullable|string|max:255',
            'iucn' => 'nullable|string|max:255',
            'nd84' => 'nullable|string|max:255',
            'nguon' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*.file' => 'required|string|max:255', // hoặc 'file' => 'required|file|mimes:jpg,jpeg,png,...' nếu là file upload
            'images.*.is_main' => 'nullable|boolean', // hoặc 'nullable|in:0,1' nếu dùng kiểu integer
        ];
    }

    public function messages(): array
    {
        return [
            '*.string' => ':attribute phải là chuỗi.',
            '*.max' => ':attribute không được vượt quá :max ký tự.',
            '*.boolean' => ':attribute phải là true hoặc false.',

            'images.array' => 'Danh sách ảnh phải là một mảng.',
            'images.*.file.required' => 'Ảnh (:position) bắt buộc phải có file.',
            'images.*.file.string' => 'File ảnh (:position) phải là chuỗi.',
            'images.*.file.file' => 'File ảnh (:position) phải là tệp tin hợp lệ.',
            'images.*.file.mimes' => 'File ảnh (:position) phải có định dạng: :values.',
            'images.*.file.max' => 'File ảnh (:position) không được vượt quá :max KB.',
            'images.*.is_main.boolean' => 'Trường "là ảnh chính" (:position) phải là true hoặc false.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nganhlatin' => 'Ngành (Latin)',
            'nganhtv' => 'Ngành (Tiếng Việt)',
            'manganh' => 'Mã ngành',
            'loplatin' => 'Lớp (Latin)',
            'loptv' => 'Lớp (Tiếng Việt)',
            'malop' => 'Mã lớp',
            'bolatin' => 'Bộ (Latin)',
            'botv' => 'Bộ (Tiếng Việt)',
            'mabo' => 'Mã bộ',
            'holatin' => 'Họ (Latin)',
            'hotv' => 'Họ (Tiếng Việt)',
            'maho' => 'Mã họ',
            'chilatin' => 'Chi (Latin)',
            'chitv' => 'Chi (Tiếng Việt)',
            'machi' => 'Mã chi',
            'danhphap2phan' => 'Danh pháp 2 phần',
            'loailatin' => 'Loài (Latin)',
            'tentacgia' => 'Tên tác giả',
            'loaitv' => 'Loài (Tiếng Việt)',
            'maloai' => 'Mã loài',
            'hinhthai' => 'Hình thái',
            'sinhthai' => 'Sinh thái',
            'pbo_vietnam' => 'Phân bố Việt Nam',
            'pbo_thegioi' => 'Phân bố Thế giới',
            'dachuu' => 'Đã chú ý',
            'giatri' => 'Giá trị',
            'sachdovn' => 'Sách đỏ Việt Nam',
            'iucn' => 'IUCN',
            'nd84' => 'Nghị định 84',
            'nguon' => 'Nguồn',
            'images' => 'Danh sách ảnh',
            'images.*.file' => 'File ảnh',
            'images.*.is_main' => 'Là ảnh chính',
        ];
    }

}
