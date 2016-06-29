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
            'name_en' => 'required|min:3',
            'logo' => 'sometimes',
            'geo_location' => 'required',
            'email'     => 'required|email|min:6|unique:organizations,email,'.$this->segment(3),
            'phone_number' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
            'links' => 'sometimes',
            'manager_id' => 'required|integer|exists:users,id',
            'min_time_before_usage_to_edit' => 'required',
            'change_fees' => 'required',
            'min_to_cancel' => 'required',
            'cancel_fees' => 'required',
            'max_to_confirm' => 'required',
            'governorate' => 'required'
        ];
    }
}
