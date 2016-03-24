<?php namespace App\Modules\Space\Requests\Admin;

use App\Http\Requests\Request;

class SpaceRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'geo_location' => 'required',
            'email'     => 'required|email|min:6|unique:spaces,email,'.$this->segment(3),
            'phone_number' => 'required',
            'logo'   => 'sometimes|max:2048|image',
            'excerpt' => 'required',
            'description' => 'required',
            'website' => 'url',
            'facebook' => 'url',
            'twitter' => 'url',
            'instagram' => 'url',
            'manager_id' => 'required|integer|exists:users,id',
            'in_return_key' => 'required',
            'in_return' => 'required',
            'status' => 'required',
            'working_week_days' => 'required',
            'working_houre_days' => 'required',
            'space_type' => 'required',
            'space_equipment' => 'required',
            'agreement_text' => 'required',
            'capacity' => 'required|integer',
            'smoking' => 'required',
            'organization' => 'required|exists:organizations,slug',



        ];
    }
}
