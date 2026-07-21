<?php

namespace App\Laravel\Requests\Backoffice;

use App\Laravel\Requests\RequestManager;

class AddChildRequest extends RequestManager
{
    public function rules()
    {
        $rules = [
            'child' => "required",
            'relationship' => "required",
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
