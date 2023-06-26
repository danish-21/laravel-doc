<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.name' => 'required|string',
            'products.*.description' => 'nullable|string',
            'products.*.category_id' => 'required|exists:categories,id',
            'products.*.price' => 'required|numeric',
            'products.*.file_id' => 'required|exists:files,id',
        ];
    }
}
