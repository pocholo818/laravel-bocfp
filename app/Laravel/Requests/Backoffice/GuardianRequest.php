<?php

namespace App\Laravel\Requests\Backoffice;

use App\Laravel\Requests\RequestManager;

class GuardianRequest extends RequestManager
{
    public function rules()
    {
        $id = $this->id ? : 0;

        $rules = [
            'first_name' => "required|name_format|min:2",
            'last_name' => "required|name_format|min:2",
            'contact_number' => "required|phone:mobile,INTERNATIONAL,PH|unique:guardians,contact_number,{$id},id",
            'address' => "required",
            'purok' => "required|integer",
            'household_id' => "required",
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
            'contact_number.unique' => "This contact number is already registered.",
            'phone' => "Please enter a valid contact number.",
            'integer' => "Invalid input. Only numbers are allowed.",
        ];
    }

}
