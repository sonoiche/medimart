<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->input('user_id');
        return [
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,'.(($id) ? $id : null).',id',
            'password'      => 'required_without:user_id|min:8|confirmed'
        ];
    }
}
