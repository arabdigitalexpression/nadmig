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
            'governorate' => 'required',
            'email'     => 'required|email|min:6',
            'phone_number' => 'required',
            'logo'   => 'sometimes|max:2048|image',
            'excerpt' => 'required',
            'description' => 'required',
            'links' => 'sometimes',
            'manager_id' => 'required|integer|exists:users,id',
            'in_return_key' => 'required',
            'in_return' => 'required',
            'status' => 'required',
            'working_week_days' => 'required',
            'working_hours_days' => 'required',
            'space_type' => 'required',
            'space_equipment' => 'required',
            'agreement_text' => 'required',
            'capacity' => 'required|integer',
            'smoking' => 'required',
            'organization_id' => 'required|exists:organizations,id',
            'min_type_for_reservation' => 'required',
            'max_type_for_reservation' => 'required',
            'min_time_before_reservation' => 'required',
            'max_time_before_reservation' => 'required',

        ];
    }
}
