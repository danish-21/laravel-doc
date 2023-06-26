<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'categories' => 'required|array',
            'categories.*.name' => 'required|string',
            'categories.*.parent_id' => 'nullable|exists:categories,id',
            'categories.*.file_id' => 'nullable|exists:files,id',
            'categories.*.is_active' => 'nullable|boolean',
        ];
    }
}
