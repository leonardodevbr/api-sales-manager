<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            "seller_id" => "required",
            "customer_id" => "required",
            "products_id" => "required",
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
            "seller_id.required" => "O campo seller_id é obrigatório.",
            "customer_id.required" => "O campo customer_id é obrigatório.",
            "products_id.required" => "O campo products_id é obrigatório.",
        ];
    }
}
