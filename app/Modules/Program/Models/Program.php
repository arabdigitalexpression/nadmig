<?php namespace App\Modules\Program\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Program extends Model{

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

	protected $fillable = ['name', 'artwork', 'description', 'user_id'];

	public function events()
	{
	    return $this->belongsToMany('App\Modules\Event\Models\Event');
	}
	public function school(){
		return $this->belongsTo('App\Modules\School\Models\School');
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
