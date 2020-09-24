<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string',
            'description'=>'nullable|string',
            'tags_id' => 'required|exists:tags,id',
            'priority_id' => 'required|exists:priorities,id',
            'timeToReady'=> 'required|date',
            'isReady' =>'required|boolean'
        ];
    }
}
