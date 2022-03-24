<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            "cpf" => ['required', Rule::unique('customers', 'cpf')->whereNull('deleted_at')->ignore($this->id)],
            "birthdate" => "required"
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
            "name.required" => "O campo name é obrigatório.",
            "cpf.required" => "O campo cpf é obrigatório.",
            "cpf.unique" => "O cpf informado já está cadastrado.",
            "birthdate.required" => "O campo birthdate é obrigatório."
        ];
    }


    public function validationData(): array
    {
        $data = $this->all();

        if (isset($data['cpf'])) {
            $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);
        }

        return $data;
    }
}
