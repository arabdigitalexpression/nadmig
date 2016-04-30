<?php namespace App\Modules\Session\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Session extends Model {

	protected $fillable = ['url_id', 'reservation_id', 'where', 'address', 'start_time', 'period', 'excerpt', 'description'];

}
