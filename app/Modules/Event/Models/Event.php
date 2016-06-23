<?php namespace App\Modules\Event\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Event extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = array(
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	protected $fillable = ['reservation_id', 'slug'];

	public function reservation()
	{
	    return $this->belongsTo('App\Modules\Reservation\Models\Reservation');
	}
	protected static function boot()
    {
        parent::boot();
        Event::creating(function ($event) {
            $event->slug = $event->slug . hash("crc32b",time() . $event->name);
        });
    }

}
