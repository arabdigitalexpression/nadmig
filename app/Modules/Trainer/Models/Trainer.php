<?php namespace App\Modules\Trainer\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model {

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
                'source' => 'user.name'
            ]
        ];
    }

	protected $fillable = ['user_id', 'bio', 'specialization'];

	public function user()
	{
	    return $this->belongsTo('App\Modules\User\Models\User');
	}
	public function events()
    {
        return $this->belongsToMany('App\Modules\Event\Models\Event');
    }
}
