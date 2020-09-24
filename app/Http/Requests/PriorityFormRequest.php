<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriorityFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required|string',
            'num'=>'required|integer|unique:priorities',
            'color'=>'nullable|string'
        ];
    }
}
