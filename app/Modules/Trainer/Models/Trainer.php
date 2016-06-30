<?php namespace App\Modules\Trainer\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model {

	protected $fillable = ['user_id', 'bio', 'specialization', 'number_workshops'];

	public function user()
	{
	    return $this->belongsTo('App\Modules\User\Models\User');
	}

}
