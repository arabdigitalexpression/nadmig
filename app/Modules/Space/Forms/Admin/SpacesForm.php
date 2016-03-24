<?php namespace App\Modules\Space\Forms\Admin;

use App\Base\Forms\AdminForm;

class SpacesForm extends AdminForm
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
        parent::buildForm();
    }
}
