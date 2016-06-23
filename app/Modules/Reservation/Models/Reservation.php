<?php namespace App\Modules\Reservation\Models;


use Illuminate\Database\Eloquent\Model;
use Auth;
use Hash;
class Reservation extends Model{



	protected $fillable = ['url_id', 'space_id', 'name','artwork', 'user_id', 'facilitator_name', 'facilitator_email', 'facilitator_phone', 'group_name', 'apply_agreement', 'group_age', 'max_attendees', 'expected_attendees', 'reserved_attendees', 'event_type', 'dooropen_time', 'dooropen_period', 'links', 'apply','apply_cost', 'apply_deadline', 'status', 'description', 'actions'];

	public function sessions()
    {
        return $this->hasMany('App\Modules\Session\Models\Session');
    }
    public function organization()
    {
        return $this->belongsTo('App\Modules\Organization\Models\Organization');
    }
    public function user()
    {
        return $this->belongsTo('App\Modules\User\Models\User');
    }
    protected static function boot()
    {
        parent::boot();
        Reservation::creating(function ($reservation) {
            $reservation->user_id = Auth::user()->id;
            $reservation->status = "pending";
            $reservation->url_id = md5(Auth::user()->id . $reservation->name . time());
        });
    }
}
