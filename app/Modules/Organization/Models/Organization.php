<?php namespace App\Modules\Organization\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model {
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

	protected $fillable = ['manager_id', 'name', 'name_en', 'geo_location', 'email', 'phone_number', 'excerpt', 'description', 'links','logo','min_time_before_usage_to_edit', 'change_fees', 'min_to_cancel', 'cancel_fees', 'max_to_confirm', 'governorate'];

	
	public function reservations()
    {
        return $this->hasMany('App\Modules\Reservation\Models\Reservation');
    }
	public function spaces()
    {
        return $this->hasMany('App\Modules\Space\Models\Space');
    }
    public function manager()
    {
        return $this->hasOne('App\Modules\User\Models\User', 'id');
    }
    public function school(){
		return $this->belongsTo('App\Modules\School\Models\School');
	}

    protected $casts = [
        'links' => 'array',
        'min_time_before_usage_to_edit' => 'object',
        'change_fees' => 'object',
        'min_to_cancel' => 'object',
        'cancel_fees' => 'object',
        'max_to_confirm' => 'object'
    ];
}
