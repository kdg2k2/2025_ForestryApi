<?php

namespace App\Http\Requests\Checkout;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use FailedValidation;
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
            "cart_ids" => "required|array",
            "cart_ids.*" => "required|integer|exists:carts,id",
        ];
    }
}
