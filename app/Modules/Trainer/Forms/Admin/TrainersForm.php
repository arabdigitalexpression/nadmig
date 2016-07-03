<?php namespace App\Modules\Trainer\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\User\Models\User;
use App\Modules\Trainer\Models\Trainer;
use App\Modules\Event\Models\Event;
class TrainersForm extends AdminForm
{
    public function buildForm()
    {
        $this
	        ->add('user_id', 'choice', [
	            'choices' => $this->getUsers($this->model),
                'selected' => $this->user_id,
	            'label' => trans('Trainer::dashboard.fields.trainer.language_id')
	        ])
            ->add('bio', 'textarea', [
                'label' => trans('Trainer::dashboard.fields.trainer.bio')
            ])
            ->add('specialization', 'text', [
                'label' => trans('Trainer::dashboard.fields.trainer.specialization')
            ])
            ->add('workshops', 'choice', [
                'choices' => $this->getWorkshops(),
                'selected' => $this->getTrainerWorkshop($this->model),
                'attr' => ['class' => 'chosen-select chosen-rtl'],
                'multiple' => true,
                'label' => trans('Trainer::dashboard.fields.trainer.workshops')
            ]);
        parent::buildForm();
    }
    protected function getUsers($trainer = null){
        $array = array();
        if($trainer != null){
            $user = $trainer->user;
            $array = array_add($array, $user['id'], $user['name']);   
        }else{
            foreach (User::all() as $user)
            {   
                if($user->hasRole('user') && is_null($user->trainer)){
                    $array = array_add($array, $user['id'], $user['name']);   
                }
            } 
        }
        return $array;
    }
    protected function getWorkshops(){
        $array = array();
        foreach (Event::all() as $event)
        {    
            if($event->program()->first() && $event->school){
                $array = array_add($array, $event['id'], $event->reservation['name']);    
            }
        }       
        return $array;
    }
    private function getTrainerWorkshop($trainer = null){
        $array = array();
        if($trainer == null){
            return $array;
        }else{
            foreach ($trainer->events as $event)
            {    
               array_push($array, $event->id);   
            }
            return $array;
        }
    }
}
