<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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
    public function rules()
    {
        return [
            "name" => "required",
            "cnpj" => "required",
            "email" => "sometimes|required",
            "password" => "sometimes|required"
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "name.required" => "O name batch_id é obrigatório.",
            "cnpj.required" => "O cnpj code é obrigatório.",
            "email.required" => "O email name é obrigatório.",
            "password.required" => "O password color é obrigatório."
        ];
    }
}
