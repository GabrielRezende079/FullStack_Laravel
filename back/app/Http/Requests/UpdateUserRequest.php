<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this-> route()-> parameter('user'); // Obtém o ID do usuário da rota

        return [
            "name" => "required", // nome é obrigatório
            "email" => "required|email|unique:users,email,{$userId}", // email é obrigatório, formato email e único na tabela users
            "date_of_birth" => "nullable|date|before:today",
        ];
    }
}
