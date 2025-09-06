<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriaConjuntoRequest extends FormRequest
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
            'descripcion' => 'required',
            'imagen' => [
                'required',
                'image', // Verifica que sea una imagen
                'mimes:jpeg,png,jpg', // Tipos de archivo permitidos
                'max:2048', // Tamaño máximo en kilobytes (2MB en este caso)
            ]
        ];
    }
}
