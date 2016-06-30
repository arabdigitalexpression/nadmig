<?php namespace App\Modules\School\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Organization\Models\Organization;
use App\Modules\Program\Models\Program;
class SchoolsForm extends AdminForm
{
    public function buildForm()
    {
        $this
	        ->add('name', 'text', [
	            'label' => trans('School::dashboard.fields.school.name')
	        ])
	        ->add('organization_id', 'choice', [
                'choices' => $this->getOrgnizations(),
                'selected' => $this->organization_id,
                'attr'  => ['id' => 'organization'],
                'label' => trans('School::dashboard.fields.organization')
            ])
            ->add('program_id', 'choice', [
                'choices' => $this->getPrograms(),
                'selected' => $this->program_id,
                'attr'  => ['id' => 'program'],
                'label' => trans('School::dashboard.fields.program')
            ]);
        parent::buildForm();
    }
    protected function getOrgnizations(){
        $array = array();
        foreach (Organization::all() as $org)
        {    
            $array = array_add($array, $org['id'], $org['name']);   
        }
        return $array;
    }
    protected function getPrograms(){
        $array = array();
        foreach (Program::all() as $program)
        {    
            $array = array_add($array, $program['id'], $program['name']);   
        }
        return $array;
    }
}
