<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "batch_id" => "required",
            "code" => "required",
            "name" => "required",
            "color" => "required",
            "description" => "required",
            "price" => "required"
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
            "batch_id.required" => "O campo batch_id é obrigatório.",
            "code.required" => "O campo code é obrigatório.",
            "name.required" => "O campo name é obrigatório.",
            "color.required" => "O campo color é obrigatório.",
            "description.required" => "O campo description é obrigatório.",
            "price.required" => "O campo price é obrigatório."
        ];
    }
}