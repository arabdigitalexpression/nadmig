<?php namespace App\Modules\School\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Organization\Models\Organization;
use App\Modules\Program\Models\Program;
use App\Modules\School\Models\School;
use App\Modules\User\Models\User;
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
            // ->add('kids', 'choice', [
            //     'choices' => $this->getKids($this->model),
            //     'selected' => $this->getSchoolKids($this->model),
            //     'attr' => ['class' => 'chosen-select chosen-rtl'],
            //     'multiple' => true,
            //     'label' => trans('School::dashboard.fields.program')
            // ])
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
    protected function getKids($school = null){
        $array = array();
        if($school != null){
            foreach (User::all() as $user)
            {    
                if($user->hasRole('user') && is_null($user->school()->first())){
                    $array = array_add($array, $user['id'], $user['email']);    
                }
            } 
            foreach ($school->kids as $kid)
            {    
                $array = array_add($array, $kid['id'], $kid['email']);    
            } 
        }else{
           foreach (User::all() as $user)
            {    
                if($user->hasRole('user') && is_null($user->school()->first())){
                    $array = array_add($array, $user['id'], $user['email']);    
                }
            } 
        }        
        return $array;
    }
    private function getSchoolKids($school = null){
        $array = array();
        if($school == null){
            return $array;
        }else{
            foreach (School::findOrFail($school['id'])->kids as $kid)
            {    
               array_push($array, $kid->id);   
            }
            return $array;
        }
    }
}
