<?php

namespace App\Http\Requests\home;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PedirExameRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cartao_sus' => 'required|string|max:20',
            'endereco' => 'required|string',
            'nome_exame' => 'required|string',
            'nome_mae' => 'required|string',
            'cid10_diagnostico' => 'nullable|string',
            'motivo_consulta' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'cartao_sus.required' => 'O número do cartão SUS é obrigatório.',
            'cartao_sus.string' => 'O número do cartão SUS deve ser uma string.',
            'cartao_sus.max' => 'O número do cartão SUS não pode ter mais de 20 caracteres.',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.string' => 'O endereço deve ser uma string.',
            'nome_exame.required' => 'O nome do exame é obrigatório.',
            'nome_exame.string' => 'O nome do exame deve ser uma string.',
            'nome_mae.required' => 'O nome da mãe é obrigatório.',
            'nome_mae.string' => 'O nome da mãe deve ser uma string.',
            'cid10_diagnostico.nullable' => 'O código CID-10 do diagnóstico é opcional.',
            'cid10_diagnostico.string' => 'O código CID-10 do diagnóstico deve ser uma string.',
            'motivo_consulta.required' => 'O motivo da consulta é obrigatório.',
            'motivo_consulta.string' => 'O motivo da consulta deve ser uma string.',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
