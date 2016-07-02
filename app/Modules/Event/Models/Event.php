<?php namespace App\Modules\Event\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Event extends Model{

	use SluggableScopeHelpers;
	use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

	protected $fillable = ['reservation_id'];

	public function reservation()
	{
	    return $this->belongsTo('App\Modules\Reservation\Models\Reservation');
	}
	public function apply()
	{
	    return $this->hasMany('App\Modules\Apply\Models\Apply');
	}
	public function program()
	{
	    return $this->belongsToMany('App\Modules\Program\Models\Program');
	}
	protected static function boot()
    {
        parent::boot();
        Event::creating(function ($event) {
            // $event->slug = $event->slug . hash("crc32b",time() . $event->name);
            $event->status = 'accepted';
        });
    }

}
