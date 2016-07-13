<?php namespace App\Modules\Report\Models;


use Illuminate\Database\Eloquent\Model;
use Auth;
class Report8 extends Model{

	protected $table = 'report_8';
	
	protected $fillable = ['user_id', 'organization_id', 'what_happens', 'notes', 'does_it_achive_the_goal', 'trainer_explaination_intraction', 'trainer_answers', 'trainer_intraction', 'workshop_overall'];

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
        Report8::creating(function ($report) {
            $report->user_id = Auth::user()->id;
            if(Auth::user()->hasRole('organization_manager')){
                $report->organization_id = Auth::user()->manageOrganization->id;
            }
        });

    }

}
