<?php namespace App\Modules\School\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class School extends Model {

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

	protected $fillable = ['name', 'organization_id', 'program_id'];

	public function program()
	{
	    return $this->belongsTo('App\Modules\Program\Models\Program');
	}
	public function organization()
	{
	    return $this->belongsTo('App\Modules\Organization\Models\Organization');
	}
    public function kids()
    {
        return $this->belongsToMany('App\Modules\User\Models\User');
    }

}
