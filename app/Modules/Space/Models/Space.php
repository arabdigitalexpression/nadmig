<?php namespace App\Modules\Space\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Space extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = array(
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	protected $fillable = ['manager_id', 'name', 'geo_location', 'email', 'phone_number', 'excerpt', 'description', 'website', 'facebook', 'twitter', 'instagram', 'in_return_key', 'in_return', 'status', 'working_week_days', 'working_houre_days', 'space_type', 'space_equipment', 'agreement_text', 'capacity', 'smoking', 'organization'];


}
