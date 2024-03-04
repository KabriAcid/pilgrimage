<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlhajiREquest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'alhajiId' => 'required',
            'fullName' => 'required',
            'passportNo' => 'required',
            'lga' => 'required',
            'gender' => 'required',
            'town' => 'required',
            'healthStatus' => 'required',
            'hajjYear' => 'required',
            'pictureFile' => 'nullable',
            
        ];
    }
    public function attributes()
    {
        return [
            'alhajiID' => 'Identification Number',
            'passportNo' => 'Passport Number',

            
        ];
    }
}
