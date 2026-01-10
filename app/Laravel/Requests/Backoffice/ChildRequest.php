<?php

namespace App\Laravel\Requests\Backoffice;

use App\Laravel\Requests\RequestManager;

class ChildRequest extends RequestManager
{
    public function rules()
    {
        $id = $this->id ? : 0;

        $rules = [
            'first_name' => "required|name_format|min:2",
            'last_name' => "required|name_format|min:2",
            'birthdate' => "required|date",
            'sex' => "required",
            'status' => "required",
        ];

        return $rules;
    }

    public function messages()
    {

        $role = $this->input('role');

        return [
            'required'	=> "Field is required.",
            'name_format' => "Invalid name. Only letters, spaces, hyphens (-), and apostrophes (') are allowed.",
            'date' => "Invalid date format.",
        ];
    }

}
