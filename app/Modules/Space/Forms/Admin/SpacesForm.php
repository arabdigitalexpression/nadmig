<?php namespace App\Modules\Space\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Organization\Models\Organization;
use App\Modules\Role\Models\Role;
class SpacesForm extends AdminForm
{
    public function buildForm()
    {
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
            ->add('geo_location', 'text', [
                'label' => trans('Space::dashboard.fields.space.geo_location')
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
            ->add('website', 'text', [
                'label' => trans('Space::dashboard.fields.space.website')
            ])
            ->add('facebook', 'text', [
                'label' => trans('Space::dashboard.fields.space.facebook')
            ])
            ->add('twitter', 'text', [
                'label' => trans('Space::dashboard.fields.space.twitter')
            ])
            ->add('instagram', 'text', [
                'label' => trans('Space::dashboard.fields.space.instagram')
            ])
            ->add('in_return_key', 'choice', [
                'choices' => $this->getInReturnKeys(),
                'selected' => $this->in_return_key,
                'label' => trans('Space::dashboard.fields.space.in_return_key'),
                'attr' => ['id' => 'in_return_key']
            ])
            ->add('in_return', 'hidden', [
                'label' => trans('Space::dashboard.fields.space.in_return'), 
                'value' => 0,
                'attr' => ['id' => 'in_return']
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
            ])
            ->add('working_hours_days', 'hidden', [
                'value' => 0,
            ])
            ->add('space_type', 'choice', [
                'choices' => $this->getSpaceType(),
                'selected' => $this->space_type,
                'label' => trans('Space::dashboard.fields.space.space_type'),
            ])
            ->add('space_equipment', 'choice', [
                'choices' => $this->getSpaceEquipment(),
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
            ])
            ->add('organization', 'choice', [
                'choices' => $this->getOrgnizations(),
                'selected' => $this->organization,
                'label' => trans('Space::dashboard.fields.space.organization')
            ])
            ->add('manager_id', 'choice', [
                'choices' => $this->getSpaceManagers(),
                'selected' => $this->manager_id,
                'label' => trans('Space::dashboard.fields.space.manager_id')
            ])
            ->add('space_reservation', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Space::dashboard.fields.space.space_reservation')
            ])
            ->add('min_type_for_reservation', 'choice', [
                'choices' => $this->getReservationType(),
                'selected' => $this->min_type_for_reservation,
                'label' => trans('Space::dashboard.fields.space.min_time_for_reservation')
            ])
            ->add('min_time_for_reservation', 'number', [
                'label' => trans('Space::dashboard.fields.space.min_time_for_reservation'),
                'value' => 1
            ])
            ->add('min_time_before_reservation', 'number', [
                'label' => trans('Space::dashboard.fields.space.min_time_before_reservation'),
                'value' => 1
            ])
            ->add('max_time_before_reservation', 'number', [
                'label' => trans('Space::dashboard.fields.space.max_time_before_reservation'),
                'value' => 1
            ])
            ->add('min_time_before_usage_to_edit', 'number', [
                'label' => trans('Space::dashboard.fields.space.min_time_before_usage_to_edit'),
                'value' => 1
            ])
            ->add('change_fees_key', 'choice', [
                'choices' => $this->getChangeFeesKeys(),
                'selected' => $this->change_fees_key,
                'label' => trans('Space::dashboard.fields.space.change_fees'),
                'attr' => ['id' => 'in_return_key']
            ])
            ->add('change_fees', 'hidden', [
                'label' => trans('Space::dashboard.fields.space.change_fees'), 
                'value' => 0,
                'attr' => ['id' => 'change_fees']
            ]);
        parent::buildForm();
    }
    protected function getInReturnKeys(){
        return array(
            "free" => trans('Space::dashboard.fields.space.free'),
            "min" => trans('Space::dashboard.fields.space.min'),
            "max" => trans('Space::dashboard.fields.space.max'),
            "any" => trans('Space::dashboard.fields.space.any')
            );
    }
    protected function getSpaceStatus(){
        return array(
            "working" => trans('Space::dashboard.fields.space.working'),
            "stoped" => trans('Space::dashboard.fields.space.stoped'),
            "closed" => trans('Space::dashboard.fields.space.closed')
            );        
    }
    protected function getSpaceType(){
        return array(
            "libarary" => trans('Space::dashboard.fields.space.libarary'),
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
            $array = array_add($array, $org['slug'], $org['name']);   
        }
        return $array;
    }
    protected function getSpaceManagers(){
        $array = array();
        foreach (Role::find(3)->users as $user) {
            $array = array_add($array, $user['id'], $user['name']);  
        }
        return $array;
    }
    protected function getSpaceEquipment(){
        return array(
            "internet" => "اتّصال بالإنترنت", 
            "floor_sets" => "مجالس أرضية"
            );
    }
    protected function getReservationType(){
        return array(
            "hours" => "ساعات",
            "days" => "أيام"
            );
    }
    protected function getChangeFeesKeys(){
        return array(
                "null" => "لا يوجد",
                "percentage" => "نسبة من قيمة الحجز",
                "value" => "قيمة"
            );
    }
}
