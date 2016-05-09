<?php namespace App\Modules\Organization\Controllers\Admin;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Requests\Admin\OrganizationRequest;
use App\Modules\Organization\Base\Controllers\ModuleController;
use App\Modules\Organization\Controllers\Api\DataTables\OrganizationDataTable;
use Auth;
class OrganizationController extends ModuleController {
	/**
	* Image column of the model
	*
	* @var string
	*/
	private $imageColumn = "logo";


	public function index(OrganizationDataTable $dataTable)
	{ 
	  return $dataTable->render($this->viewPath());
	}

	public function store(OrganizationRequest $request)
	{
		return $this->createFlashRedirect(Organization::class, $request, $this->imageColumn);
	}

	public function show(Organization $organization)
	{
		if (Auth::user()->can('edit-orgnization')) {
			return $this->viewPath("show", $organization);
		}else if(Auth::user()->can('edit-my-orgnization')){
			if ($organization['manager_id'] == Auth::user()->id) {
				return $this->viewPath("show", $organization);
			}else{
				return response('Unauthorized.', 401);
			}
		}else{
			return response('Unauthorized.', 401);
		}
	}

	public function edit(Organization $organization)
	{
		if (Auth::user()->can('edit-orgnization')) {
		  return $this->getForm($organization);
		}else if(Auth::user()->can('edit-my-orgnization')){
		  if ($organization['manager_id'] == Auth::user()->id) {
			return $this->getForm($organization);
		  }else{
			return response('Unauthorized.', 401);
		  }
		}else{
		  return response('Unauthorized.', 401);
		}
	}

	public function update(Organization $organization, OrganizationRequest $request)
	{
		if (Auth::user()->hasRole('admin')) {
		  return $this->saveFlashRedirect($organization, $request, $this->imageColumn);
		}else if(Auth::user()->hasRole('orgnization_manager')){
		  return $this->saveFlashRedirect($organization, $request, $this->imageColumn ,'mine.show');
		}
	}

	public function destroy(Organization $organization)
	{
	  return $this->destroyFlashRedirect($organization);
	}
	public function showMyOrg()
	{
		$organization = Organization::where('manager_id' , Auth::user()->id)->first();
		if ($organization) {
		  return $this->viewPath("show", $organization);
		}else{
		  return "You don't have any organization to manage";
		}
	}
}
