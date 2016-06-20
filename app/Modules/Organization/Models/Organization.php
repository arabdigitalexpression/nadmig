<?php namespace App\Modules\Organization\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model implements SluggableInterface {

	use SluggableTrait;
	
	protected $fillable = ['manager_id', 'name', 'geo_location', 'email', 'phone_number', 'excerpt', 'description', 'links','logo','slug'];

	protected $sluggable = array(
	    'build_from' => 'slug',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);
	public function reservations()
    {
        return $this->hasMany('App\Modules\Reservation\Models\Reservation');
    }
	public function spaces()
    {
        return $this->hasMany('App\Modules\Space\Models\Space');
    }
    public function manager()
    {
        return $this->hasOne('App\Modules\User\Models\User', 'id');
    }
	

}
