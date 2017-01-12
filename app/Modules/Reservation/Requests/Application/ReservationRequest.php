<?php namespace App\Modules\Reservation\Requests\Application;

use App\Http\Requests\Request;
use App\Modules\Space\Models\Space;
class ReservationRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'artwork' => 'sometimes',
            'facilitator_name' => 'required|min:3',
            'facilitator_email' => 'required|email|min:6',
            'facilitator_phone' => 'required|min:10',
            'group_name' => 'sometimes|min:3',
            'group_age' => 'required',
            'max_attendees' => 'required|integer|max:'.$this->get('capacity'),
            'expected_attendees' => 'required|integer|max:'.$this->get('max_attendees'),
            'reserved_attendees' => 'required|integer|max:'.$this->get('max_attendees'),
            'event_type' => 'required',
            'dooropen_time' => 'required',
            'dooropen_period' => 'required',
            'event_tags' => 'required',
            'links' => 'sometimes',
            'apply' => 'sometimes',
            'apply_cost' => 'sometimes',
            'apply_deadline' => 'sometimes|date_format:d/m/Y',
            'apply_agreement' => 'sometimes', 
            'description' => 'sometimes'
        ];
    }
}
