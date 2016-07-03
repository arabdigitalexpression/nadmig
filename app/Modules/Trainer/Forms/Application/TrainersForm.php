<?php namespace App\Modules\Trainer\Forms\Application;

use App\Base\Forms\AdminForm;
use App\Modules\User\Models\User;
class TrainersForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('bio', 'textarea', [
                'label' => trans('Trainer::dashboard.fields.trainer.bio')
            ])
            ->add('specialization', 'textarea', [
                'label' => trans('Trainer::dashboard.fields.trainer.specialization')
            ]);
        parent::buildForm();
    }
    protected function getUsers(){
        $array = array();
        foreach (User::all() as $user)
        {   
            if($user->hasRole('user')){
                $array = array_add($array, $user['id'], $user['name']);   
            }
        }
        return $array;
    }
}
