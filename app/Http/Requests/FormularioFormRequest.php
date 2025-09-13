<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormularioFormRequest extends FormRequest
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
    { //Tamanho e requisições
        return [
            'nome' => 'required|max:120|min:5',
            'email'  => 'required|max:120|email|unique:formularios,email,' . $this->id,
            'telefone' => 'required|regex:/^\d{10,11}$/',
            'data_hora' => 'required|date|after_or_equal:today',
            'cargo_desejado' => 'required|max:120|min:2',
            'escolaridade' => 'required|max:100|min:2',
            'observacoes' => 'max:180|',
            'arquivo' => 'required|file|mimes:pdf,doc,docx|max:1024',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return  [
            //Nome
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome não pode ter mais de 120 caracteres.',
            'nome.min' => 'O campo nome deve ter no mínimo 5 caracteres.',
            //Email
            'email.required' => 'O campo email é obrigatório.',
            'email.max' => 'O campo email não pode ter mais de 120 caracteres.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.unique' => 'Este email já está em uso.',
            // Telefone
            'telefone.required' => 'O campo Telefone é obrigatório.',
            'telefone.max' => 'O campo Telefone não pode ter mais de 20 caracteres.',
            'telefone.min' => 'O campo Telefone deve ter no mínimo 11 caracteres.',
            //Data e Hora
            'data_hora.required' => 'O campo Data e Hora é obrigatório.',
            'data_hora.date' => 'O campo Data e Hora está em formáto inválido',
            //Cargo Desejado
            'cargo_desejado.required' => 'O campo Cargo Desejado é obrigatório.',
            'cargo_desejado.max' => 'O campo Cargo Desejado não pode ter mais de 120 caracteres.',
            'cargo_desejado.required' => 'O campo Cargo Desejado é obrigatório.',
            'cargo_desejado.min' => 'O campo Cargo Desejado tem que ter no mínimo 2 caracteres.',
            //Escolaridade
            'escolaridade.required' => 'O campo Escolaridade é obrigatório.',
            'escolaridade.max' => 'O campo Escolaridade não pode ter mais de 100 caracteres.',
            'escolaridade.required' => 'O campo Escolaridade é obrigatório.',
            //Observações
            'observacoes.max' => 'O campo Observações não pode ter mais de 180 caracteres.',

            //Arquivo
            'arquivo.required' => 'O envio do arquivo é obrigatório.',
            'arquivo.file'     => 'O campo deve ser um arquivo válido.',
            'arquivo.mimes'    => 'Somente são permitidos arquivos do tipo: doc, docx e pdf.',
            'arquivo.max'      => 'O arquivo não pode ultrapassar 1MB de tamanho.',

        ];
    }
}
