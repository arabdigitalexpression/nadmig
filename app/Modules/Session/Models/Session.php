<?php namespace App\Modules\Session\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Session extends Model{
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

	protected $fillable = ['space_id', 'reservation_id','start_date',  'start_time', 'fees', 'period', 'excerpt', 'description', 'status', 'name'];

	public function reservation()
     {
        return $this->belongsTo('App\Modules\Reservation\Models\Reservation');
     }
     public function space()
     {
        return $this->belongsTo('App\Modules\Space\Models\Space');
     }
    protected static function boot()
    {
        parent::boot();
        Session::creating(function ($session) {
            $session->status = "pending";
        });
    }
    protected $casts = [
        'period' => 'object'
    ];
}
