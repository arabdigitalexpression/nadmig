<?php namespace App\Modules\Role\Forms\Admin;

use App\Base\Forms\AdminForm;

class RolesForm extends AdminForm
{
    public function buildForm()
    {
       $this
            ->add('name', 'text', [
                'label' => trans('Role::admin.fields.role.name'),
            ])
            ->add('display_name', 'text', [
                'label' => trans('Role::admin.fields.role.display_name')
            ])
             ->add('description', 'textarea', [
                'label' => trans('Role::admin.fields.role.description')
            ]);
        parent::buildForm();
    }
}
