<?php namespace App\Modules\Organization\Controllers\Admin;

use App\Modules\Organization\Models\Organization;
use App\Modules\Organization\Requests\Admin\OrganizationRequest;
use App\Modules\Organization\Base\Controllers\ModuleController;
use App\Modules\Organization\Controllers\Api\DataTables\OrganizationDataTable;
use App\Base\Controllers\LogController;
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
	public function create()
	{
		if (Auth::user()->hasRole('admin')) {
		  return $this->getForm();
		}
		return response('Unauthorized.', 401);   
	}
	public function store(OrganizationRequest $request)
	{
		if (Auth::user()->hasRole('admin')) {
			
		  return $this->createFlashRedirect(Organization::class, $request, $this->imageColumn);
		}
		return response('Unauthorized.', 401);  	
	}

	public function show(Organization $organization)
	{
		if ((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('organization_manager') && $organization['manager_id'] == Auth::user()->id)) {
			return $this->viewPath("show", $organization);
		}else{
			return response('Unauthorized.', 401);
		}
	}

	public function edit(Organization $organization)
	{
		
		if ((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('organization_manager') && $organization['manager_id'] == Auth::user()->id)) {
			return $this->getForm($organization);
		}else{
			return response('Unauthorized.', 401);
		}
	}

	public function update(Organization $organization, OrganizationRequest $request)
	{

		if (Auth::user()->hasRole('admin') || (Auth::user()->can('edit-my-orgnization') && $organization['manager_id'] == Auth::user()->id)) {
		  return $this->saveFlashRedirect($organization, $request, $this->imageColumn);
		}
		return response('Unauthorized.', 401);
	}

	public function destroy(Organization $organization)
	{
		if (Auth::user()->hasRole('admin')) {
		  return $this->destroyFlashRedirect($organization);
		}
		return response('Unauthorized.', 401);
	  
	}
	public function showMyOrg()
	{
		$organization = Auth::user()->manageOrganization;
		if ($organization) {
		  return $this->viewPath("show", $organization);
		}else{
		  return "You don't have any organization to manage";
		}
	}
}
