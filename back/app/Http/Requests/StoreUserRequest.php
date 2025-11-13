<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            "name" => "required", // nome é obrigatório
            "email" => "required|email|unique:users,email", // email é obrigatório, formato email e único na tabela users
            "date_of_birth" => "nullable|date|before:today", // obrigatório e formato data antes de hoje
        ];
    }
}
