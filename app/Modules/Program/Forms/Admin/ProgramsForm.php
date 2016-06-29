<?php namespace App\Modules\Program\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Event\Models\Event;
use App\Modules\Program\Models\Program;
use Auth;
class ProgramsForm extends AdminForm
{
    public function buildForm()
    {
        $this
		    ->add('name', 'text', [
		            'label' => trans('Program::dashboard.fields.program.name')
		        ])
            ->add('artwork', 'file', [
                'label' => trans('Program::dashboard.fields.program.picture'),
                'attr' => ['class' => '']
            ])
            ->add('description', 'textarea', [
                    'label' => trans('Program::dashboard.fields.program.description')
            ])
            ->add('events', 'choice', [
                'label' => trans('Program::dashboard.fields.program.events'),
                'choices' => $this->getEvents(),
                'selected' => $this->getProgramEvents($this->model),
                'expanded' => true,
                'multiple' => true
            ]);
        parent::buildForm();
    }
    private function getEvents(){
        $array = array();
        if(Auth::user()->hasRole('admin')){
            foreach (Event::all() as $event)
            {    
                $array = array_add($array, $event['id'], $event->reservation['name']);   
            }
        }elseif (Auth::user()->hasRole('organization_manager')) {
            foreach (Auth::user()->manageOrganization->reservations()->where('status', 'accepted')->where('event_type', 'public')->get() as $reservation)
            {    
                $array = array_add($array, $reservation->event->id, $reservation['name']);   
            }
        }

        return $array;
    }
    private function getProgramEvents($program = null){
        $array = array();
        if($program == null){
            return $array;
        }else{
            foreach (Program::findOrFail($program['id'])->events as $event)
            {    
               array_push($array, $event->id);   
            }
            return $array;
        }
    }
}
