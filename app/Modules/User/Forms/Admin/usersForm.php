<?php namespace App\Modules\User\Forms\Admin;

use App\Base\Forms\AdminForm;

class usersForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => trans('User::admin.fields.user.name')
            ])
            ->add('email', 'email', [
                'label' => trans('User::admin.fields.user.email')
            ])
            ->add('password', 'password', [
                'label' => trans('User::admin.fields.user.password')
            ])
            ->add('password_confirmation', 'password', [
                'label' => trans('User::admin.fields.user.password_confirmation')
            ])
            ->add('picture', 'file', [
                'label' => trans('User::admin.fields.user.picture'),
                'attr' => ['class' => '']
            ]);
        parent::buildForm();
    }
}
