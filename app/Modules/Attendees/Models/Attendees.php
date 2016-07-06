<?php namespace App\Modules\Attendees\Models;


use Illuminate\Database\Eloquent\Model;

class Attendees extends Model{

	protected $fillable = ['name', 'birthday', 'type', 'address', 'city', 'phone_number', 'email', 'school_name', 'track', 'hear_about_us', 'media_coverage', 'guardian_name', 'guardian_phone', 'guardian_approval'];

	protected $casts = [
		'hear_about_us' => 'object'
	];
}
