<?php namespace App\Modules\Report\Models;


use Illuminate\Database\Eloquent\Model;
use Auth;
class SpaceManager2Report extends Model{

	protected $table = 'space_manger_2_reports';

	
	protected $fillable = ['user_id', 'user_id', 'organization_id', 'type','session_id', 'date', 'attendees', 'trainer_id', 'notes'];

	public function user()
    {
        return $this->belongsTo('App\Modules\User\Models\User');
    }
    public function session()
    {
        return $this->belongsTo('App\Modules\Session\Models\Session');
    }
    public function organization()
    {
        return $this->belongsTo('App\Modules\Organization\Models\Organization');
    }
    public function trainer()
    {
        return $this->belongsTo('App\Modules\Trainer\Models\Trainer');
    }
	protected static function boot()
    {
        parent::boot();
        SpaceManager2Report::creating(function ($report) {
            
            $report->user_id = Auth::user()->id;
            if(Auth::user()->hasRole('admin')){
                $report->organization_id = $report->session->reservation->organization->id;
            }
            if(Auth::user()->hasRole('organization_manager')){
                $report->organization_id = Auth::user()->manageOrganization->id;
            }
            if(Auth::user()->hasRole('space_manager')){
                $report->organization_id = Auth::user()->manageSpace->organization->id;
            }
            $report->trainer_id = $report->session->reservation->event->trainer()->first()->id;
        });

    }
}
