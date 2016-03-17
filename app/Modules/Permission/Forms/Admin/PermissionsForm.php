<?php namespace App\Modules\Permission\Forms\Admin;

use App\Base\Forms\AdminForm;

class PermissionsForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => trans('Permission::dashboard.fields.permission.name'),
            ])
            ->add('display_name', 'text', [
                'label' => trans('Permission::dashboard.fields.permission.display_name')
            ])
             ->add('description', 'textarea', [
                'label' => trans('Permission::dashboard.fields.permission.description')
            ]);
        parent::buildForm();
    }
}
