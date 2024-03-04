<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'propertyId' => 'required',
            'propertyname' => 'required',
            'location' => 'required',
            'distance' => 'required',
            'address' => 'required',
            'numberOfFloor' => 'nullable|numeric',
            'hajjYear' => 'required',
            'numberOfRooms' => 'required|numeric',
            'totalBedSpaces' => 'required|numeric',
            'picture' => 'nullable|image',


        ];
    }
    public function attributes()
    {
        return [
            'propertyID' => 'Property short Id',
            'propertyname' => 'Property identifible name',

            'numberOfRooms' => 'Number of rooms',
            'totalBedSpaces' => 'total bed spaces',

        ];
    }
}
