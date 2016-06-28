<?php namespace App\Modules\User\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\User\Models\User;
use App\Modules\Role\Models\Role;
class UsersForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => trans('User::dashboard.fields.user.name')
            ])
            ->add('email', 'email', [
                'label' => trans('User::dashboard.fields.user.email')
            ])
            ->add('password', 'password', [
                'label' => trans('User::dashboard.fields.user.password')
            ])
             ->add('password_confirmation', 'password', [
                'label' => trans('User::dashboard.fields.user.password_confirmation')
            ])
            ->add('birthday', 'date', [
                'label' => trans('User::dashboard.fields.user.birthday')
            ])
            ->add('governorate', 'choice', [
                'choices' => $this->getGovernorates(),
                'selected' => $this->governorate,
                'label' => trans('User::dashboard.fields.user.governorate'),
            ])
            ->add('website', 'text', [
                'label' => trans('User::dashboard.fields.user.website')
            ])
            ->add('facebook', 'text', [
                'label' => trans('User::dashboard.fields.user.facebook')
            ])
            ->add('twitter', 'text', [
                'label' => trans('User::dashboard.fields.user.twitter')
            ])
            ->add('instagram', 'text', [
                'label' => trans('User::dashboard.fields.user.instagram')
            ])
            ->add('role', 'choice', [
                'choices' => $this->getRoles(),
                'selected' => $this->getUserRole($this->model),
                'label' => trans('User::dashboard.fields.user.role'),
                'expanded' => true,
                'multiple' => true
            ])
            ->add('picture', 'file', [
                'label' => trans('User::dashboard.fields.user.picture'),
                'attr' => ['class' => '']
            ]);
        parent::buildForm();
    }   
    private function getRoles()
    {
        $array = array();
        foreach (Role::all() as $role)
        {    
            $array = array_add($array, $role['id'], $role['display_name']);   
        }
        return $array;
    }
    private function getUserRole($user = null){
        dd($user);
        $array = array();
        if($user == null){
            return $array;
        }else{
            foreach ($user->roles as $role)
            {    
               array_push($array, $role['id']);   
            }
            return $array;
        }
    }
}
