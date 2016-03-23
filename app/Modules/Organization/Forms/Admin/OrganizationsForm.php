<?php namespace App\Modules\Organization\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\User\Models\User;
use App\Modules\Role\Models\Role;
use Auth;
class OrganizationsForm extends AdminForm
{
    public function buildForm()
    {
        $this
		    ->add('name', 'text', [
	            'label' => trans('Organization::dashboard.fields.organization.name')
	        ])
            ->add('geo_location', 'text', [
                'label' => trans('Organization::dashboard.fields.organization.geo_location')
            ])
            ->add('email', 'email', [
                'label' => trans('Organization::dashboard.fields.organization.email')
            ])
            ->add('phone_number', 'text', [
                'label' => trans('Organization::dashboard.fields.organization.phone_number')
            ])
            ->add('excerpt', 'textarea', [
                'label' => trans('Organization::dashboard.fields.organization.excerpt')
            ])
            ->add('description', 'textarea', [
                'label' => trans('Organization::dashboard.fields.organization.description')
            ])
            ->add('website', 'text', [
                'label' => trans('Organization::dashboard.fields.organization.website')
            ])
            ->add('facebook', 'text', [
                'label' => trans('Organization::dashboard.fields.organization.facebook')
            ])
            ->add('twitter', 'text', [
                'label' => trans('Organization::dashboard.fields.organization.twitter')
            ])
            ->add('instagram', 'text', [
                'label' => trans('Organization::dashboard.fields.organization.instagram')
            ]);
            if ( Auth::user()->ability('admin', 'create-orgnization,edit-orgnization') ){
               $this->add('manager_id', 'choice', [
                    'choices' => $this->getOrgnizationManagers(),
                    'selected' => $this->manager_id,
                    'label' => trans('Organization::dashboard.fields.organization.manager_id'),
                ]);
            }else{
                $this->add('manager_id', 'hidden', [
                    'value' => $this->manager_id
                ]);
            }
        parent::buildForm();
    }
    protected function getOrgnizationManagers(){
        $array = array();
        foreach (Role::find(2)->users as $user) {
            $array = array_add($array, $user['id'], $user['name']);  
        }
        return $array;
    }
}
