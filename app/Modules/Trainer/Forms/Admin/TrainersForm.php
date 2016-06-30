<?php namespace App\Modules\Trainer\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\User\Models\User;
class TrainersForm extends AdminForm
{
    public function buildForm()
    {
        $this
	        ->add('user_id', 'choice', [
	            'choices' => $this->getUsers(),
                'selected' => $this->user_id,
	            'label' => trans('Trainer::dashboard.fields.trainer.language_id')
	        ])
            ->add('bio', 'textarea', [
                'label' => trans('Trainer::dashboard.fields.trainer.bio')
            ])
            ->add('specialization', 'text', [
                'label' => trans('Trainer::dashboard.fields.trainer.specialization')
            ])
            ->add('number_workshops', 'number', [
                'label' => trans('Trainer::dashboard.fields.trainer.number_workshops')
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
