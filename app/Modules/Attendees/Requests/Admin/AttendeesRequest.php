<?php namespace App\Modules\Attendees\Requests\Admin;

use App\Http\Requests\Request;

class AttendeesRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'birthday' => 'required',
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'school_name' => 'required',
            'track' => 'required',
            'hear_about_us' => 'required',
            'media_coverage' => 'required',
            'guardian_name' => 'required',
            'guardian_phone' => 'required',
            'guardian_approval' => 'required',

        ];
    }
}
