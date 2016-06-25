<?php namespace App\Modules\Apply\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Apply extends Model {

	protected $fillable = ['event_id', 'user_id'];

	public function user()
    {
        return $this->belongsTo('App\Modules\User\Models\User');
    }
    public function event()
    {
        return $this->belongsTo('App\Modules\Event\Models\Event');
    }
    public function reservation()
    {
        return $this->event->reservation();
    }
    protected static function boot()
    {
        parent::boot();
        Apply::creating(function ($event) {
            $event->user_id = Auth::user()->id;
        });
    }

}
