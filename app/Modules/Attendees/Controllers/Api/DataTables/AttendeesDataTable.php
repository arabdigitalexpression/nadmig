<?php namespace App\Modules\Attendees\Controllers\Api\DataTables;

use App\Modules\Attendees\Models\Attendees;
use App\Modules\Attendees\Base\Controllers\ModuleDataTableController;
use Auth;
class AttendeesDataTable extends ModuleDataTableController {

  protected $columns = ['name','birthday', 'type', 'address', 'city', 'phone_number', 'email', 'school_name', 'track', 'media_coverage', 'guardian_name', 'guardian_phone', 'guardian_approval'];
  
  protected $common_columns = ['created_at'];
  protected $options = ['edit'];
  public function query()
  {
  	if(Auth::user()->hasRole('admin')){
  		$attendees = Attendees::query();
  	}else if(Auth::user()->hasRole('organization_manager')){
      $attendees = Attendees::query()->where('organization_id', Auth::user()->manageOrganization['id']);
  	}
      return $this->applyScopes($attendees);
  }

}
