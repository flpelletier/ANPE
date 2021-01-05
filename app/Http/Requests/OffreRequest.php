<?php

namespace App\Http\Requests;

use App\Offre;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OffreRequest extends FormRequest
{
 

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titre' => [
                'required', 'min:3'
            ],
            'description' => [
                'required', 'min:3'
            ],
            'niveau' => [
                'required', 'min:3'
            ]
        ];
    }
}
