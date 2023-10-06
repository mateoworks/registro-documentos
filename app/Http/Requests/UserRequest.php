<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ],
            'password' => [
                Rule::requiredIf(function () {
                    return $this->isMethod('post');
                }),
            ],
            'url_foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],
            'rol' => ['required']
        ];
    }
}
