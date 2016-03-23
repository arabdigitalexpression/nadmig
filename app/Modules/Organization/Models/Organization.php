<?php namespace App\Modules\Organization\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model implements SluggableInterface {

	use SluggableTrait;
	
	protected $fillable = ['manager_id', 'name', 'geo_location', 'email', 'phone_number', 'excerpt', 'description', 'website', 'facebook', 'twitter', 'instagram'];

	protected $sluggable = array(
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	

}
