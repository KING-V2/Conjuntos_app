<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEncuestasRespuestasRequest extends FormRequest
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
            'mes' => ['required', 'string', 'max:30'],
            'opciones' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'encuesta_id' => ['required'],
        ];
    }
}
