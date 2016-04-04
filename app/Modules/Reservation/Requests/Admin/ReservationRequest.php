<?php namespace App\Modules\Reservation\Requests\Admin;

use App\Http\Requests\Request;

class ReservationRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'start_time' => 'required',
            'usage_period' => 'required|integer',
            'excerpt' => 'required',
            'description' => 'required',
            'facilitator_name' => 'required|min:3',
            'facilitator_email' => 'required|email|min:6',
            'facilitator_phone' => 'required|min:10',
            'group_name' => 'required|min:3',
            'apply_agreement' => 'required',
            'group_age' => 'required',
            'max_attendees' => 'required|integer|max:'.$this->get('capacity'),
            'expected_attendees' => 'required|integer|max:'.$this->get('max_attendees'),
            'reserved_attendees' => 'required|integer|max:'.$this->get('max_attendees'),
            'event_type' => 'required',
            'dooropen_time' => 'required',
            'dooropen_period' => 'required',
            'links' => 'sometimes',
            'fees' => 'required',
            'apply_cost' => 'required',
            'apply_deadline' => 'required|date_format:d/m/Y'
        ];
    }
}
