<?php namespace App\Modules\Organization\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model implements SluggableInterface {

	use SluggableTrait;
	
	protected $sluggable = array(
	    'build_from' => 'name_en',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	protected $fillable = ['manager_id', 'name', 'name_en', 'geo_location', 'email', 'phone_number', 'excerpt', 'description', 'links','logo','min_time_before_usage_to_edit', 'change_fees', 'min_to_cancel', 'cancel_fees', 'max_to_confirm'];

	
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
