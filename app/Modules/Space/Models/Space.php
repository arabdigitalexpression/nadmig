<?php namespace App\Modules\Space\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Space extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = array(
	    'build_from' => 'title',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	protected $fillable = ['content', 'language_id', 'title'];

	public function language()
	{
	    return $this->belongsTo('App\Language');
	}

}
