<?php namespace App\Modules\Program\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Event\Models\Event;
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
                'expanded' => true,
                'multiple' => true
            ]);
        parent::buildForm();
    }
    private function getEvents(){
        $array = array();
        foreach (Event::all() as $event)
        {    
            $array = array_add($array, $event['id'], $event->reservation['name']);   
        }
        return $array;
    }
}
