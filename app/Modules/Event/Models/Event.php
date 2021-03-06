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

	protected $fillable = ['reservation_id', 'name'];

	public function reservation()
	{
	    return $this->belongsTo('App\Modules\Reservation\Models\Reservation');
	}
    public function organization()
    {
        return $this->reservation->organization();
    }
	public function apply()
	{
	    return $this->hasMany('App\Modules\Apply\Models\Apply');
	}
	public function program()
	{
	    return $this->belongsToMany('App\Modules\Program\Models\Program');
	}
    public function trainer()
    {
        return $this->belongsToMany('App\Modules\Trainer\Models\Trainer');
    }
    public function school()
    {
        return $this->program->first()->school();
    }
    public function report()
    {
        return $this->hasOne('App\Modules\Report\Models\TrainerReport');
    }
    public function attendees(){
        return $this->belongsToMany('App\Modules\Attendees\Models\Attendees');
    }
	protected static function boot()
    {
        parent::boot();
        Event::creating(function ($event) {
            unset($event->name);
            $event->status = 'accepted';
        });
    }

}
