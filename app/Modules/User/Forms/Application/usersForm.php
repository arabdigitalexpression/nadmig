<?php namespace App\Modules\User\Forms\Application;

use App\Base\Forms\AdminForm;
class usersForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('picture', 'file', [
                'label' => trans('User::application.fields.user.picture'),
                'attr' => ['class' => '']
            ])
            ->add('name', 'text', [
                'label' => trans('User::application.fields.user.name')
            ])
            ->add('email', 'email', [
                'label' => trans('User::application.fields.user.email')
            ])
            ->add('password', 'password', [
                'label' => trans('User::application.fields.user.password')
            ])
             ->add('password_confirmation', 'password', [
                'label' => trans('User::application.fields.user.password_confirmation')
            ])
            ->add('birthday', 'text', [
                'label' => trans('User::application.fields.user.birthday'),
                'attr' => ['id' => 'birthday']
            ])
            ->add('governorate', 'choice', [
                'choices' => $this->getGovernorates(),
                'selected' => $this->governorate,
                'label' => trans('User::application.fields.user.governorate'),
            ])
            ->add('website', 'text', [
                'label' => trans('User::application.fields.user.website')
            ])
            ->add('facebook', 'text', [
                'label' => trans('User::application.fields.user.facebook')
            ])
            ->add('twitter', 'text', [
                'label' => trans('User::application.fields.user.twitter')
            ])
            ->add('instagram', 'text', [
                'label' => trans('User::application.fields.user.instagram')
            ])->add('register', 'submit', [
                'label' => trans('User::application.fields.user.register'),
                'attr' => ['class' => 'btn bg-auth btn-block btn-flat']
            ]);
        
    }   

}
