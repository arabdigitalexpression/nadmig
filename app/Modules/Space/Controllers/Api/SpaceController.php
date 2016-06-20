<?php namespace App\Modules\Space\Controllers\Api;

use App\Modules\Space\Models\Space;
use App\Modules\Space\Base\Controllers\ModuleController;

class SpaceController extends ModuleController {

  public function fees_time(Space $space)
  {
    if($space){
      return array_only($space->toArray(), array('working_week_days','working_hours_days', 'in_return_key', 'in_return', 'agreement_text'));
    }
  }
}
