<?php namespace App\Modules\Organization\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Organization\Models\Organization;

class OrganizationController extends ApplicationController {

	public function index(Organization $organization)
	{
		return view('Organization::application.index', compact('organization'));
	}
	public function organization(Organization $organization){
		$organization['links'] = json_decode($organization['links']);
		$organization['spaces'] = $organization->spaces;
		return view('Organization::application.show', compact('organization'));	
	}
}
