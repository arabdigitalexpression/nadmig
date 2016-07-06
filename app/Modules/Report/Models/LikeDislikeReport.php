<?php namespace App\Modules\Report\Models;


use Illuminate\Database\Eloquent\Model;
use Auth;
class LikeDislikeReport extends Model{

	protected $table = 'like_dislike_reports';

	
	protected $fillable = ['user_id','organization_id', 'like','dislike', 'need_to_enhance'];

	public function user()
    {
        return $this->belongsTo('App\Modules\User\Models\User');
    }
    public function organization()
    {
        return $this->belongsTo('App\Modules\Organization\Models\Organization');
    }
	protected static function boot()
    {
        parent::boot();
        LikeDislikeReport::creating(function ($report) {
            $report->user_id = Auth::user()->id;
            if(Auth::user()->hasRole('organization_manager')){
                $report->organization_id = Auth::user()->manageOrganization->id;
            }
        });

    }
}
