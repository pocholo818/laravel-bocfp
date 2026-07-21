<?php

namespace App\Laravel\Requests\Backoffice;

use App\Laravel\Requests\RequestManager;

class RecordRequest extends RequestManager
{
    public function rules()
    {
        // $id = $this->id ? : 0;

        $rules = [
            'height' => "required",
            'weight' => "required",
        ];

        return $rules;
    }

    public function messages()
    {

        $role = $this->input('role');

        return [
            'required'	=> "Field is required.",
        ];
    }

}
