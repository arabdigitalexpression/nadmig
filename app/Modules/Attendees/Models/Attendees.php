<?php namespace App\Modules\Attendees\Models;


use Illuminate\Database\Eloquent\Model;

class Attendees extends Model{

	protected $fillable = ['name', 'birthday', 'type', 'address', 'city', 'phone_number', 'email', 'school_name', 'track', 'hear_about_us', 'media_coverage', 'guardian_name', 'guardian_phone', 'guardian_approval', 'organization_id'];

	public function events()
	{
	    return $this->belongsToMany('App\Modules\Event\Models\Event');
	}

	public function organization()
	{
	    return $this->belongsTo('App\Modules\Organization\Models\Organization');
	}
	protected $casts = [
		'hear_about_us' => 'object'
	];
}
