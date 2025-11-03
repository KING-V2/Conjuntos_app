<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest
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
            'tipo_pago' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'comentario_admin' => 'required|string',
            'adjunto' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',            
            'estado' => 'nullable|string',
            'comentario_admin' => 'nullable|string'
        ];
    }
}
