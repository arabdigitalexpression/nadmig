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
            ->add('slug', 'text', [
                'label' => trans('Organization::dashboard.fields.organization.slug')
            ])
            ->add('logo', 'file', [
                'label' => trans('Organization::dashboard.fields.organization.logo'),
                'attr' => ['class' => ''],
                'value' => function ($logo) {
                    if($logo){ return $logo; }else { return 0; };
                }
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
                'label' => trans('Organization::dashboard.fields.organization.excerpt'), 
                'attr' => ['id' => 'excerpt']
            ])
            ->add('description', 'textarea', [
                'label' => trans('Organization::dashboard.fields.organization.description'),
                'attr' => ['id' => 'description']
            ])
            ->add('links', 'collection', [
                'type' => 'form',
                'wrapper' => false,
                'label'=> false,
                'prototype' => true,            // Should prototype be generated. Default: true
                'prototype_name' => '__NAME__',
                'options' => [    // these are options for a single type
                    'class' => 'App\Forms\Admin\LinksForm',
                    'label' => false,
                    'is_child' => true
                ]
            ]);
            if ( Auth::user()->hasRole('admin') ){
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
