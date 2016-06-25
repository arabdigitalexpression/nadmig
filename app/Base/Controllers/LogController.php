<?php

namespace App\Base\Controllers;

use App\Http\Controllers\Controller;
use Activity;

class LogController extends Controller
{
	
	public static function Log($model, $action, $relation = null){
		if(preg_match('/Request/', class_basename(get_class($model)))){
			$className = str_replace('Request', '', class_basename(get_class($model)));
		}else{
			$className = class_basename(get_class($model));
		}
		if ($relation) {
			$belongTo = ' belong to ' . class_basename(get_class($relation)) . ' ' . $relation->name . ' with id ' . $relation->id ; 
			Activity::log($className . ' ' . $model->name . ' with id ' . $model->id . $belongTo . ' was ' . $action);
		}else{
			Activity::log($className . ' ' . $model->name . ' with id ' . $model->id . ' was ' . $action);
		}
	}
}