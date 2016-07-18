<?php

namespace App\Base\Controllers;

use App\Http\Controllers\Controller;
use Activity;
use Auth;
use Carbon\Carbon;
class LogController extends Controller
{
	
	public static function Log($model, $action, $relation = null, $request = null){
		if(preg_match('/Request/', class_basename(get_class($model)))){
			$className = str_replace('Request', '', class_basename(get_class($model)));
		}else{
			$className = class_basename(get_class($model));
		}
		if ($action != "created") {
			if($model->getDirty()){
				foreach ($model->getDirty() as $key => $value) {
					$changes = 'changing the value of ' . $key . ' from ' . $model->getOriginal()[$key] . ' to ' . $value;
					if ($relation) {
						$belongTo = ' belong to ' . class_basename(get_class($relation)) . ' having id ' . $relation->id ; 
						Activity::log('User ' . Auth::user()->name . ' having ID ' . Auth::user()->id . ' has ' .$action . ' ' .  $className . ' having id ' . $model->id . ' ' . $belongTo . ' on ' . Carbon::now() . ' ' . $changes);
					}else{
						Activity::log('User ' . Auth::user()->name . ' having ID ' . Auth::user()->id . ' has ' .$action . ' ' .  $className . ' having id ' . $model->id . ' on ' . Carbon::now() . ' ' . $changes);
					}
				}	
			}
		}else{
			Activity::log('User ' . Auth::user()->name . ' having ID ' . Auth::user()->id . ' has ' .$action . ' ' .  $className . ' having id ' . $model->id . ' on ' . Carbon::now());
		}
		
	}
}