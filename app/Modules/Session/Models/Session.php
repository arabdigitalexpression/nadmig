<?php namespace App\Modules\Session\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Session extends Model {

	protected $fillable = ['space_id', 'reservation_id', 'start_time', 'fees', 'period', 'excerpt', 'description'];

	public function reservation()
     {
        return $this->belongsTo('App\Modules\Reservation\Models\Reservation');
     }

}
