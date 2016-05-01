<?php namespace App\Modules\Reservation\Forms\Application;

use App\Base\Forms\AdminForm;
use Auth;
class ReservationsForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => trans('Reservation::application.fields.reservation.name')
            ])
            ->add('space_info', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Reservation::application.fields.reservation.info')
            ])
            ->add('session', 'collection', [
                'type' => 'form',
                'wrapper' => false,
                'label'=> false,
                'prototype' => true,            // Should prototype be generated. Default: true
                'prototype_name' => '__NAME__',
                'options' => [    // these are options for a single type
                    'class' => 'App\Modules\Session\Forms\Application\SessionsForm',
                    'label' => false,
                    'is_child' => true
                ],
                'empty_row' => false // This was added
            ])
            ->add('facilitator_info', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Reservation::application.fields.reservation.facilitator')
            ])
            ->add('facilitator_name', 'text', [
                'label' => trans('Reservation::application.fields.reservation.facilitator_name'),  
                'value' => function ($facilitator_name) {
                            if(Auth::check()){
                                return Auth::user()->name;
                            }
                            return $facilitator_name;
                        }
            ])
            ->add('facilitator_email', 'email', [
                'label' => trans('Reservation::application.fields.reservation.facilitator_email'),  
                'value' => function ($facilitator_email) {
                            if(Auth::check()){
                                return Auth::user()->email;
                            }
                            return $facilitator_email;
                        }
            ])
            ->add('facilitator_phone', 'text', [
                'label' => trans('Reservation::application.fields.reservation.facilitator_phone')
            ])
            ->add('group_name', 'text', [
                'label' => trans('Reservation::application.fields.reservation.group_name')
            ])
            ->add('extra_info', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Reservation::application.fields.reservation.extra')
            ])
            ->add('apply_agreement', 'textarea', [
                'label' => trans('Reservation::application.fields.reservation.apply_agreement')
            ])
            ->add('group_age', 'choice', [
                'choices' => $this->getGroupAge(),
                'selected' => $this->group_age,
                'label' => trans('Reservation::application.fields.reservation.group_age')
            ])
             ->add('capacity', 'hidden', [
                'label' => false,
                'value' => $this->data[0]['capacity']
            ])
            ->add('max_attendees', 'number', [
                'label' => trans('Reservation::application.fields.reservation.max_attendees') . $this->getHelpMassage($this->data[0]['capacity'] . " بالاقصى")
            ])
            ->add('expected_attendees', 'number', [
                'label' => trans('Reservation::application.fields.reservation.expected_attendees')
            ])
            ->add('reserved_attendees', 'number', [
                'label' => trans('Reservation::application.fields.reservation.reserved_attendees')
            ])
            ->add('event_type', 'choice', [
                'choices' => $this->getEventtype(),
                'selected' => $this->event_type,
                'label' => trans('Reservation::application.fields.reservation.event_type')
            ]);
            $this->OptionAndPeriod('dooropen_time', trans('Reservation::application.fields.reservation.dooropen_time'));
            $this->OptionAndPeriod('dooropen_period', trans('Reservation::application.fields.reservation.dooropen_period'));
            $this->add('fees_info', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => [],
                'value' => $this->getFees()
            ])
            ->add('fees', 'number', [
                'label' => trans('Reservation::application.fields.reservation.fees')
            ])
            ->add('apply_cost', 'number', [
                'label' => trans('Reservation::application.fields.reservation.apply_cost'),
                'value' => function ($name) {
                    if($name){ return $name; }else { return 0; };
                },
            ])
            ->add('apply_deadline', 'text', [
                'label' => trans('Reservation::application.fields.reservation.apply_deadline'),
                'attr' => ['id' => 'apply_deadline']
            ]);
        parent::buildForm();
    }
    protected function getGroupAge(){
        return array(
            'null' => 'غير معيّن',
            // add group ages
            );
    }
    protected function getHelpMassage($msg){
        return $msg;
    }
    protected function getEventtype(){
        return array(
            'private' => 'خاص',
            'public' => 'عام'
            );
    }
    protected function getFees(){
        $space = $this->data[0];
        if($space['in_return_key'] == 'free'){
            return trans('Reservation::application.fields.reservation.free');

        }else if($space['in_return_key'] == 'min'){
            return trans('Reservation::application.fields.reservation.min') .  $this->data[0]['in_return'];
        }
        else if($space['in_return_key'] == 'max'){
            return trans('Reservation::application.fields.reservation.max') .  $this->data[0]['in_return'];
        }
        else if($space['in_return_key'] == 'any'){
            return trans('Reservation::application.fields.reservation.any') .  $this->data[0]['in_return'];
        }
    }
    protected function getReservationType($isNull){
        $array = array();
        if ($isNull) {
            $array['null'] = "لا يوجد";
        };
        $array['mins'] = "دقائق";
        $array['hours'] = "ساعات";
        return $array;
    }
     protected function OptionAndPeriod($name, $title, $isNull = true){
        if ($isNull) {
            $type = 'hidden';
        }else{
            $type = 'number';
        }
        $this
            ->add($name . '[type]', 'choice', [
                'choices' => $this->getReservationType($isNull),
                'selected' => $this->{$name},
                'label' => $title,
                'attr' => ['id' => $name . '_type']
            ])
            ->add($name . '[period]', $type, [
                'label' => false,
                'value' => function ($name) {
                    return $name;
                },
                'attr' => ['id' => $name . '_period']
            ]);
    }
}