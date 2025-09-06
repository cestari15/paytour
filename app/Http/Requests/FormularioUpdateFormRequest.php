<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormularioUpdateFormRequest extends FormRequest
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
            'nome' => 'sometimes|max:120|min:5',
            'email'  => 'sometimes|max:120|email|unique:formularios,email,' . $this->id,
            'telefone' => 'sometimes|max:20|min:8',
            'data_hora' => 'sometimes|date',
            'cargo_desejado' => 'sometimes|max:120|min:2',
            'escolaridade' => 'sometimes|max:100|min:2',
            'observacoes' => 'sometimes|max:180|min:3',
            'arquivo' => 'sometimes|file|mimes:pdf,doc,docx|max:1024',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return  [
            'nome.max' => 'O campo nome não pode ter mais de 120 caracteres.',
            'nome.min' => 'O campo nome deve ter no mínimo 5 caracteres.',

            'email.max' => 'O campo email não pode ter mais de 120 caracteres.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.unique' => 'Este email já está em uso.',

            'data_hora.date' => 'O campo Data e Hora está em formáto inválido',

            'cargo_desejado.max' => 'O campo Cargo Desejado não pode ter mais de 120 caracteres.',
            'cargo_desejado.min' => 'O campo Cargo Desejado tem que ter no mínimo 2 caracteres.',

            'escolaridade.max' => 'O campo Escolaridade não pode ter mais de 100 caracteres.',
            'escolaridade.min' => 'O campo Escolaridade deve ter no mínimo 2 caracteres.',

            'observacoes.max' => 'O campo Observações não pode ter mais de 180 caracteres.',
            'observacoes.min' => 'O campo Observações tem que ter no mínimo 3 caracteres.',

            'arquivo.file'     => 'O campo deve ser um arquivo válido.',
            'arquivo.mimes'    => 'Somente são permitidos arquivos do tipo: doc, docx e pdf.',
            'arquivo.max'      => 'O arquivo não pode ultrapassar 1MB de tamanho.',

            'telefone.max' => 'O campo Telefone não pode ter mais de 20 caracteres.',
            'telefone.min' => 'O campo Telefone deve ter no mínimo 8 caracteres.',

        ];
    }
}
