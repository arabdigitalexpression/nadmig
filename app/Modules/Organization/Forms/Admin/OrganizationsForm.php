<?php namespace App\Modules\Organization\Forms\Admin;

use App\Base\Forms\AdminForm;

class OrganizationsForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Organization::dashboard.fields.organization.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Organization::dashboard.fields.organization.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Organization::dashboard.fields.organization.content')
            ]);
        parent::buildForm();
    }
}
