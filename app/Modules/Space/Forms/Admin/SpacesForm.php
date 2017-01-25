<?php namespace App\Modules\Space\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Organization\Models\Organization;
use App\Modules\Role\Models\Role;
use Auth;
use App\Setting;
class SpacesForm extends AdminForm
{
    public function buildForm()
    {
        $settings = include base_path('./resources/settings.php');
        $this
            ->add('space_info', 'static', [

                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Space::dashboard.fields.space.space_info')
            ])
		    ->add('name', 'text', [
                'label' => trans('Space::dashboard.fields.space.name')
            ])
            ->add('address', 'text', [
                'label' => trans('Space::dashboard.fields.space.address')
            ])
            ->add('governorate', 'choice', [
                'choices' => $this->getGovernorates(),
                'selected' => $this->governorate,
                'label' => trans('Space::dashboard.fields.space.governorate'),
            ])
            ->add('email', 'email', [
                'label' => trans('Space::dashboard.fields.space.email')
            ])
            ->add('phone_number', 'text', [
                'label' => trans('Space::dashboard.fields.space.phone_number')
            ])
            ->add('logo', 'file', [
                'label' => trans('Space::dashboard.fields.space.logo'),
                'attr' => ['class' => '']
            ])
            ->add('excerpt', 'textarea', [
                'label' => trans('Space::dashboard.fields.space.excerpt')
            ])
            ->add('description', 'textarea', [
                'label' => trans('Space::dashboard.fields.space.description')
            ])
            ->add('links', 'collection', [
                'type' => 'form',
                'wrapper' => false,
                'label'=> false,
                'prototype' => true,            // Should prototype be generated. Default: true
                'prototype_name' => '__NAME__',
                'options' => [    // these are options for a single type
                    'class' => 'App\Forms\Admin\LinksForm',
                    'label' => false,
                    'is_child' => true
                ]
            ])
            ->add('in_return_key', 'choice', [
                'choices' => $this->getInReturnKeys(),
                'selected' => $this->in_return_key,
                'label' => trans('Space::dashboard.fields.space.in_return_key'),
                'attr' => ['id' => 'in_return_key']
            ])
            ->add('in_return', 'hidden', [
                'label' => trans('Space::dashboard.fields.space.in_return'), 
                'attr' => ['id' => 'in_return']
            ])
            ->add('usage_period_key', 'choice', [
                'choices' => $this->getUsagePeriodKeys(),
                'selected' => $this->usage_period_key,
                'label' => trans('Space::dashboard.fields.space.usage_period_key'),
                'attr' => ['id' => 'usage_period_key']
            ])
            ->add('usage_period', 'number', [
                'label' => false, 
                'attr' => ['id' => 'usage_period']
            ])
            ->add('status', 'choice', [
                'choices' => $this->getSpaceStatus(),
                'selected' => $this->status,
                'label' => trans('Space::dashboard.fields.space.status'),
            ])
            ->add('working_week_days', 'choice', [
                'choices' => $this->getWeekdays(),
                'selected' => $this->working_week_days,
                'label' => trans('Space::dashboard.fields.space.working_week_days'),
                'expanded' => true,
                'multiple' => true
            ]);
            $this->WeekDaysForm();
        $this
            ->add('space_type', 'choice', [
                'choices' => $settings['space_type'],
                'selected' => $this->space_type,
                'label' => trans('Space::dashboard.fields.space.space_type'),
                'attr' => ['class' => 'chosen-select chosen-rtl'],
                'multiple' => true
            ])
            ->add('space_equipment', 'choice', [
                'choices' => $settings['space_equipment'],
                'selected' => $this->space_equipment,
                'label' => trans('Space::dashboard.fields.space.space_equipment'),
                'attr' => ['class' => 'chosen-select chosen-rtl'],
                'multiple' => true
            ])
            ->add('agreement_text', 'textarea', [
                'label' => trans('Space::dashboard.fields.space.agreement_text')
            ])
            ->add('capacity', 'number', [
                'label' => trans('Space::dashboard.fields.space.capacity')
            ])
            ->add('smoking', 'choice', [
                'choices' => $this->getSmoking(),
                'selected' => $this->smoking,
                'label' => trans('Space::dashboard.fields.space.smoking')
            ]);
            if(Auth::user()->hasRole('admin')){
                $this->add('organization_id', 'choice', [
                    'choices' => $this->getOrgnizations(),
                    'selected' => $this->organization,
                    'label' => trans('Space::dashboard.fields.space.organization')
                ])
                ->add('manager_id', 'choice', [
                    'choices' => $this->getSpaceManagers(),
                    'selected' => $this->manager_id,
                    'label' => trans('Space::dashboard.fields.space.manager_id')
                ]);
            }else if(Auth::user()->hasRole('organization_manager')){
                 $this->add('organization_id', 'hidden', [
                    'value' => Auth::user()->manageOrganization['id']
                ])
                ->add('manager_id', 'choice', [
                    'choices' => $this->getSpaceManagers(),
                    'selected' => $this->manager_id,
                    'label' => trans('Space::dashboard.fields.space.manager_id')
                ]);
            }else if(Auth::user()->hasRole('space_manager')){
                 $this->add('organization_id', 'hidden', [
                    'value' => Auth::user()->manageOrganization['id']
                ])
                ->add('manager_id', 'hidden', [
                    'value' => $this->manager_id
                ]);
            }
            
            $this->add('space_reservation', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Space::dashboard.fields.space.space_reservation')
            ]);
            $this->OptionAndPeriod('min_type_for_reservation', trans('Space::dashboard.fields.space.min_time_for_reservation'), false, true,true, false);
            $this->OptionAndPeriod('max_type_for_reservation', trans('Space::dashboard.fields.space.max_time_for_reservation'), false, false,true, true);
            $this->OptionAndPeriod('min_time_before_reservation', trans('Space::dashboard.fields.space.min_time_before_reservation'));
            $this->OptionAndPeriod('max_time_before_reservation', trans('Space::dashboard.fields.space.max_time_before_reservation'));
            // $this->OptionAndPeriod('reset_time', trans('Space::dashboard.fields.space.reset_time'), false, true, true, false);

        parent::buildForm();
    }
    protected function getInReturnKeys(){
        return array(
            "free" => trans('Space::dashboard.fields.space.free'),
            "min" => trans('Space::dashboard.fields.space.min'),
            "exact" => trans('Space::dashboard.fields.space.exact'),
            "any" => trans('Space::dashboard.fields.space.any')
            );
    }
    protected function getUsagePeriodKeys(){
        return array(
            "hours" => trans('Space::dashboard.fields.space.hours'),
            "days" => trans('Space::dashboard.fields.space.days')
            );   
    }
    protected function getSpaceStatus(){
        return array(
            "working" => trans('Space::dashboard.fields.space.working'),
            "stopped" => trans('Space::dashboard.fields.space.stopped'),
            "closed" => trans('Space::dashboard.fields.space.closed')
            );        
    }
    protected function getSpaceType(){
        return array(
            "library" => trans('Space::dashboard.fields.space.libarary'),
            "cinema" => trans('Space::dashboard.fields.space.cinema'),
            "sound_studio" => trans('Space::dashboard.fields.space.sound_studio'),
            "lecture_hole" => trans('Space::dashboard.fields.space.lecture_hole'), 
            "workshop" => trans('Space::dashboard.fields.space.workshop'),
            "computer_lap" => trans('Space::dashboard.fields.space.computer_lap'),
            "hackspace" => trans('Space::dashboard.fields.space.hackspace'), 
            "salon" => trans('Space::dashboard.fields.space.salon'), 
            "dancing_hole" => trans('Space::dashboard.fields.space.dancing_hole'),
            "sport_hole" => trans('Space::dashboard.fields.space.sport_hole'),
            "space" => trans('Space::dashboard.fields.space.space'),
            "studying_room" => trans('Space::dashboard.fields.space.studying_room'), 
            "scince_lap" => trans('Space::dashboard.fields.space.scince_lap'),
            );
    }
    protected function getSmoking(){
        return array(
            "yes" => "مسموح",
            "no" => "غير مسموح"
            );
    }
    protected function getOrgnizations(){
        $array = array();
        foreach (Organization::all() as $org)
        {    
            $array = array_add($array, $org['id'], $org['name']);   
        }
        return $array;
    }
    protected function getSpaceManagers(){
        $array = array();
        if(Auth::user()->hasRole('organization_manager')){
            $array = array_add($array, Auth::user()->id, Auth::user()->name);  
        }
        if(Auth::user()->hasRole('admin')){
            foreach (Role::find(2)->users as $user) {
                $array = array_add($array, $user['id'], $user['name']);  
            }
        }
        foreach (Role::find(3)->users as $user) {
            $array = array_add($array, $user['id'], $user['name']);  
        }
        return $array;
    }
    protected function getSpaceEquipment(){
        $settings = include base_path('./resources/settings.php');
        return $settings['space_equipment'];
    }
    protected function WeekDaysForm()
    {
        $this->add('working_hours', 'static', [
                'label' => false,
                'tag' => 'div',
                'value' => trans('Space::dashboard.fields.space.working_hours_days')
        ]);
        foreach ($this->getWeekdays() as $key => $value) {
            $this
                ->add('working_hours_days['.$key.']', 'static', [
                        'wrapper' => ['class' => 'weekday_name'],
                        'label' => false,
                        'tag' => 'h4',
                        'value' => $value
                ])
                ->add('working_hours_days['.$key.'][from]', 'text', [
                    'wrapper' => ['class' => 'weekday_from'],
                    'label' => trans('Space::dashboard.fields.space.from'),
                    'tag' => 'span',
                    'attr' => ['id' => $key.'_from', 'class' => '']
                ])
                ->add('working_hours_days['.$key.'][to]', 'text', [
                    'wrapper' => ['class' => 'weekday_to'],
                    'label' => trans('Space::dashboard.fields.space.to'),
                    'tag' => 'span',
                    'attr' => ['id' => $key.'_to', 'class' => '']
                ]);
        }
    }
}


