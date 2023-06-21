<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        $rules = [
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'name' => ['required', 'string'],
            'phone' => 'required',
            'password' => [
                'required'
            ],
        ];
        if (!$this->isTesting()) {
            $rules['email'][] = Rule::unique('users');
        }
        return $rules;
    }
    /**
     * Determine if the current request is from testing.
     *
     * @return bool
     */
    private function isTesting()
    {
        return app()->environment('testing');
    }
}
