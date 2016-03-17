<?php namespace App\Modules\Role\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Permission\Models\Permission;
use App\Modules\Role\Models\Role;

class RolesForm extends AdminForm
{
    public function buildForm()
    {
       $this
            ->add('name', 'text', [
                'label' => trans('Role::dashboard.fields.role.name'),
            ])
            ->add('display_name', 'text', [
                'label' => trans('Role::dashboard.fields.role.display_name')
            ])
             ->add('description', 'textarea', [
                'label' => trans('Role::dashboard.fields.role.description')
            ])
            ->add('permission', 'choice', [
                'choices' => $this->getPermissions(),
                'selected' => $this->getRolePermission($this->model),
                'label' => trans('Role::dashboard.fields.role.permission'),
                'expanded' => true,
                'multiple' => true
            ]);
        parent::buildForm();
    }
    private function getPermissions()
    {
        $array = array();
        foreach (Permission::all() as $role)
        {    
            $array = array_add($array, $role['id'], $role['display_name']);   
        }
        return $array;
    }
    private function getRolePermission($role = null){
        $array = array();
        if($role == null){
            return $array;
        }else{
            foreach (Role::find($role['id'])->perms as $permission)
            {    
               array_push($array, $permission['id']);   
            }
            return $array;
        }
    }
}
