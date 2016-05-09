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
            ->add('slug', 'text', [
                'label' => trans('Space::dashboard.fields.space.slug')
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
            ]);
            $this->WeekDaysForm();
        $this
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
            ]);
            $this->OptionAndPeriod('min_type_for_reservation', trans('Space::dashboard.fields.space.min_time_for_reservation'), false);
            $this->OptionAndPeriod('max_type_for_reservation', trans('Space::dashboard.fields.space.max_time_for_reservation'), false);
            $this->OptionAndPeriod('min_time_before_reservation', trans('Space::dashboard.fields.space.min_time_before_reservation'));
            $this->OptionAndPeriod('max_time_before_reservation', trans('Space::dashboard.fields.space.max_time_before_reservation'));
            $this->OptionAndPeriod('min_time_before_usage_to_edit', trans('Space::dashboard.fields.space.min_time_before_usage_to_edit'));
           $this
                ->add('change_fees[type]', 'choice', [
                    'choices' => $this->getChangeFeesKeys(),
                    'selected' => $this->change_fees['type'],
                    'label' => trans('Space::dashboard.fields.space.change_fees'),
                    'expanded' => true,
                    'attr' => ['id' => 'change_fees_key']
                ])
                ->add('change_fees[amount]', 'hidden', [
                    'label' => trans('Space::dashboard.fields.space.change_fees'), 
                    'attr' => ['id' => 'change_fees', 'class' => 'space_number']
                ]);
            $this->OptionAndPeriod('min_to_cancel', trans('Space::dashboard.fields.space.min_to_cancel'));
            $this
                ->add('cancel_fees[type]', 'choice', [
                    'choices' => $this->getChangeFeesKeys(),
                    'selected' => $this->cancel_fees['type'],
                    'expanded' => true,
                    'label' => trans('Space::dashboard.fields.space.cancel_fees'),
                    'attr' => ['id' => 'cancel_fees_key']
                ])
                ->add('cancel_fees[amount]', 'hidden', [
                    'label' => false, 
                    'attr' => ['id' => 'cancel_fees', 'class' => 'space_number']
                ]);
            $this->OptionAndPeriod('max_to_confirm', trans('Space::dashboard.fields.space.max_to_confirm'), false);
            $this->OptionAndPeriod('reset_time', trans('Space::dashboard.fields.space.reset_time'), false, true);
            $this->OptionAndPeriod('max_event_per_time', trans('Space::dashboard.fields.space.max_event_per_time'));
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
            $array = array_add($array, $org['id'], $org['name']);   
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
    protected function getReservationType($isNull, $isMin){
        $array = array();
        if ($isNull) {
            $array['null'] = "لا يوجد";
        };
        if ($isMin) {
            $array['mins'] = "دقائق";
        };
        $array['hours'] = "ساعات";
        $array['days'] = "أيام";
        return $array;
    }
    protected function getChangeFeesKeys(){
        return array(
                "null" => "لا يوجد",
                "percentage" => "نسبة من قيمة الحجز",
                "value" => "قيمة"
            );
    }
    protected function OptionAndPeriod($name, $title, $isNull = true, $isMin = false){
        if ($isNull) {
            $type = 'hidden';
        }else{
            $type = 'number';
        }
        $this
            ->add($name . '[type]', 'choice', [
                'choices' => $this->getReservationType($isNull, $isMin),
                'selected' => $this->{$name},
                'label' => $title,
                'expanded' => true,
                'attr' => ['id' => $name . '_type']
            ])
            ->add($name . '[period]', $type, [
                'wrapper' => ['class' => 'period_val'],
                'label' => false,
                'value' => function ($name) {
                    return $name;
                },
                'attr' => ['id' => $name . '_period', 'class' => 'space_number']
            ]);
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


