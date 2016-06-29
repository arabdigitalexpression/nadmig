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
            ->add('name_en', 'text', [
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
            ->add('governorate', 'choice', [
                'choices' => $this->getGovernorates(),
                'selected' => $this->governorate,
                'label' => trans('Organization::dashboard.fields.user.governorate'),
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
            $this->add('organization_reservation', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Organization::dashboard.fields.space.organization_reservation')
            ]);
            $this->OptionAndPeriod('min_time_before_usage_to_edit', trans('Organization::dashboard.fields.space.min_time_before_usage_to_edit'));
           $this
                ->add('change_fees[type]', 'choice', [
                    'choices' => $this->getChangeFeesKeys(),
                    'selected' => $this->change_fees['type'],
                    'label' => trans('Organization::dashboard.fields.space.change_fees'),
                    'expanded' => true,
                    'attr' => ['id' => 'change_fees_key']
                ])
                ->add('change_fees[amount]', 'hidden', [
                    'label' => trans('Organization::dashboard.fields.space.change_fees'), 
                    'attr' => ['id' => 'change_fees', 'class' => 'space_number']
                ]);
            $this->OptionAndPeriod('min_to_cancel', trans('Organization::dashboard.fields.space.min_to_cancel'));
            $this
                ->add('cancel_fees[type]', 'choice', [
                    'choices' => $this->getChangeFeesKeys(),
                    'selected' => $this->cancel_fees['type'],
                    'expanded' => true,
                    'label' => trans('Organization::dashboard.fields.space.cancel_fees'),
                    'attr' => ['id' => 'cancel_fees_key']
                ])
                ->add('cancel_fees[amount]', 'hidden', [
                    'label' => false, 
                    'attr' => ['id' => 'cancel_fees', 'class' => 'space_number']
                ]);
            $this->OptionAndPeriod('max_to_confirm', trans('Organization::dashboard.fields.space.max_to_confirm'), false, false, true, true);
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
