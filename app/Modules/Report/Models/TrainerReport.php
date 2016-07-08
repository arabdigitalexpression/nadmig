<?php namespace App\Modules\Report\Models;


use Illuminate\Database\Eloquent\Model;
use Auth;
class TrainerReport extends Model{

	protected $table = 'trainer_reports';

	
	protected $fillable = ['event_id', 'attendees_id', 'trainer_id', 'week','confidence', 'initiative', 'respect_and_accept', 'team_work', 'critical_thinking', 'imagination', 'open_to_change', 'ability_to_understand_the_content', 'ability_to_produce_art', 'ability_to_thinking', 'ability_to_inovate'];

	public function attende()
    {
        return $this->belongsTo('App\Modules\Attendees\Models\Attendees', 'attendees_id');
    }
    public function event()
    {
        return $this->belongsTo('App\Modules\Event\Models\Event');
    }
    public function trainer()
    {
        return $this->belongsTo('App\Modules\Trainer\Models\Trainer');
    }
	protected static function boot()
    {
        parent::boot();
        TrainerReport::creating(function ($report) {
            $report->trainer_id = Auth::user()->trainer->id;
        });

    }
    protected $casts = [
         'confidence' => 'object',
         'initiative' => 'object',
         'respect_and_accept' => 'object',
         'team_work' => 'object',
         'critical_thinking' => 'object',
         'imagination' => 'object',
         'open_to_change' => 'object',
         'ability_to_understand_the_content' => 'object',
         'ability_to_produce_art' => 'object',
         'ability_to_thinking' => 'object',
         'ability_to_inovate' => 'object',
    ];
}
