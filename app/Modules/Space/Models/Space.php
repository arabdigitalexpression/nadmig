<?php namespace App\Modules\Space\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Space extends Model {
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

	protected $fillable = ['manager_id', 'name', 'address', 'email', 'phone_number', 'excerpt', 'description', 'links', 'in_return_key', 'in_return', 'status', 'working_week_days', 'working_houre_days', 'space_type', 'space_equipment', 'agreement_text', 'capacity', 'smoking', 'organization_id', 'min_type_for_reservation', 'max_type_for_reservation', 'min_time_before_reservation', 'max_time_before_reservation', 'logo','working_hours_days', 'governorate'];
	
    public function organization()
    {
        return $this->belongsTo('App\Modules\Organization\Models\Organization');
    }	
    public function sessions()
    {
        return $this->hasMany('App\Modules\Session\Models\Session');
    } 

    protected static function boot()
    {
        parent::boot();
        Space::creating(function ($space) {
            if(!$space->logo){
                $space->logo = "/files/space_picture.png";
            }
        });
    }

    protected $casts = [
        'links' => 'array',
        'working_week_days' => 'object',
        'working_hours_days' => 'object',
        'space_equipment' => 'object',
        'space_type' => 'object',
        'min_type_for_reservation' => 'object',
        'max_type_for_reservation' => 'object',
        'min_time_before_reservation' => 'object',
        'max_time_before_reservation' => 'object'
    ];
}
