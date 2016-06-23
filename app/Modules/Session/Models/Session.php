<?php namespace App\Modules\Session\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Session extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug'
    );

	protected $fillable = ['space_id', 'reservation_id','start_date',  'start_time', 'fees', 'period', 'excerpt', 'description', 'status', 'name', 'slug'];

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
            $session->slug = $session->slug . hash("crc32b",time() . $session->name);
        });
    }
}
