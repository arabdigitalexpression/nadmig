<?php namespace App\Modules\Program\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Program extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = array(
	    'build_from' => 'name',
	    'save_to'    => 'slug',
	    'on_update'  => true
	);

	protected $fillable = ['name', 'artwork', 'description', 'user_id'];

	public function events()
	{
	    return $this->belongsToMany('App\Modules\Event\Models\Event');
	}
	protected static function boot()
    {
        parent::boot();
        Program::creating(function ($program) {
            $program->slug = $program->slug . hash("crc32b",time() . $program->name);
            $program->user_id = Auth::user()->id;
        });
    }
}
