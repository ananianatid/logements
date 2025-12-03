<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipementAppartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'appartement_id' => ['sometimes', 'exists:appartements,id'],
            'nom_equipement' => ['sometimes', 'string', 'max:255'],
            'quantite' => ['sometimes', 'integer', 'min:1'],
            'etat' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
