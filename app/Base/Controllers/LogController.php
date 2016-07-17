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
		// if ($action != "created") {
		// 	$changes = 'changing the value of ' . . ' from ' . . ' to [new value]';
		// }
		if ($relation) {
			$belongTo = ' belong to ' . class_basename(get_class($relation)) . ' having id ' . $relation->id ; 
			Activity::log('User ' . Auth::user()->name . ' having ID ' . Auth::user()->id . ' has ' .$action . ' ' .  $className . ' having id ' . $model->id . $belongTo . ' on ' . Carbon::now());
		}else{
			Activity::log($className . ' ' . $model->name . ' with id ' . $model->id . ' was ' . $action);
		}
	}
}
// User [user.username] having ID [user.id] has [action]
// [object.reservation.request] having ID [object.reservation.ID] on
// [action.timestamp] changing the value of [fieldname] from [oldvalue] to
// [new value].