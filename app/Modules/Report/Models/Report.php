<?php namespace App\Modules\Report\Models;


use Illuminate\Database\Eloquent\Model;

class Report extends Model{

	protected $fillable = ['content', 'language_id', 'title'];

	public function language()
	{
	    return $this->belongsTo('App\Language');
	}

}
