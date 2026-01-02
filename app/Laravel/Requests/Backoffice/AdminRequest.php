<?php

namespace App\Laravel\Requests\Backoffice;

use App\Laravel\Requests\RequestManager;

class AdminRequest extends RequestManager
{
    public function rules()
    {
        $id = $this->admin_id ? : 0;

        $rules = [
            // 'username' => "required|unique:users,username",
            'name' => "required|name_format|min:2",
            'email' => "required|email|unique:users,email,{$id},id|allowed_domain",
            'contact_number' => "required|phone:mobile,INTERNATIONAL,PH|unique:users,contact_number,{$id},id",
            // 'type' => "required",
            // 'role' => "required",
            'status' => "required",
        ];

        return $rules;
    }

    public function messages()
    {

        $role = $this->input('role');

        return [
            'required'	=> "Field is required.",
            'unique' => "This :attribute is already taken.",
            'email' => "Please enter a valid email address.",
            'contact_number.unique' => "This contact number is already registered.",
            'phone' => "Please enter a valid contact number.",
            'name_format' => "Invalid name. Only letters, spaces, hyphens (-), and apostrophes (') are allowed.",
        ];
    }

}
