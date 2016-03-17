<?php namespace App\Modules\User\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\User\Models\User;
use App\Modules\Role\Models\Role;
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
            ->add('role', 'choice', [
                'choices' => $this->getRoles(),
                'selected' => $this->getUserRole($this->model),
                'label' => trans('User::admin.fields.user.role'),
                'expanded' => true,
                'multiple' => true
            ])
            ->add('picture', 'file', [
                'label' => trans('User::admin.fields.user.picture'),
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
        $array = array();
        if($user == null){
            return $array;
        }else{
            foreach (User::findOrFail($user['id'])->roles as $role)
            {    
               array_push($array, $role['id']);   
            }
            return $array;
        }
    }
}
