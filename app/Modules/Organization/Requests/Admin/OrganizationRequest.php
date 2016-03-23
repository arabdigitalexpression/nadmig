<?php namespace App\Modules\Organization\Requests\Admin;

use App\Http\Requests\Request;

class OrganizationRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'geo_location' => 'required',
            'email'     => 'required|email|min:6|unique:organizations,email,'.$this->segment(3),
            'phone_number' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
            'website' => 'url',
            'facebook' => 'url',
            'twitter' => 'url',
            'instagram' => 'url',
            'manager_id' => 'required|integer|exists:users,id'
        ];
    }
}
