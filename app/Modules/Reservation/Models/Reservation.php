<?php namespace App\Modules\Reservation\Models;


use Illuminate\Database\Eloquent\Model;

class Reservation extends Model{



	protected $fillable = ['url_id', 'space_id', 'name', 'start_time', 'usage_period', 'excerpt', 'description', 'user_id', 'facilitator_name', 'facilitator_email', 'facilitator_phone', 'group_name', 'apply_agreement', 'group_age', 'max_attendees', 'expected_attendees', 'reserved_attendees', 'event_type', 'dooropen_time', 'dooropen_period', 'links', 'fees','apply_cost', 'apply_deadline', 'status'];

	public function sessions()
    {
        return $this->hasMany('App\Modules\Session\Models\Session');
    }

}
