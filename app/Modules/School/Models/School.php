<?php namespace App\Modules\School\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class School extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = array(
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	protected $fillable = ['name', 'organization_id', 'program_id'];

	public function program()
	{
	    return $this->hasOne('App\Modules\Program\Models\Program');
	}
	public function organization()
	{
	    return $this->belongsTo('App\Modules\Organization\Models\Organization');
	}

}
