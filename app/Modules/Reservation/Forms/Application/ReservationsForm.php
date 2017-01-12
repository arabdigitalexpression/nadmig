<?php namespace App\Modules\Reservation\Forms\Application;

use App\Base\Forms\AdminForm;
use Auth;
class ReservationsForm extends AdminForm
{
    public function buildForm()
    {
        $settings = include base_path('./resources/settings.php');
        $this
            ->add('name', 'text', [
                'label' => trans('Reservation::application.fields.reservation.name')
            ])
            ->add('artwork', 'file', [
                'label' => trans('Reservation::application.fields.reservation.artwork'),
                'attr' => ['class' => '']
            ])
            ->add('description', 'textarea', [
                'label' => trans('Reservation::application.fields.reservation.description'),
                 'attr' => ['id' => 'description']
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
            ->add('group_age', 'choice', [
                'choices' => $this->getGroupAge(),
                'selected' => $this->group_age,
                'label' => trans('Reservation::application.fields.reservation.group_age')
            ]);
            // $spaces = $this->data[0]->spaces->toArray();
            // $this->sortBy('capacity',   $spaces);
            // $this->add('capacity', 'hidden', [
            //     'label' => false,
            //     'value' => $spaces[0]['capacity']
            // ])
            $this->add('max_attendees', 'number', [
                'label' => trans('Reservation::application.fields.reservation.max_attendees') . $this->getHelpMassage($spaces[0]['capacity'] . " بالاقصى")
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
            $this->add('event_tags', 'choice', [
                'choices' => $settings['event_tags'],
                'selected' => $this->event_tags,
                'label' => trans('Reservation::dashboard.fields.reservation.event_tags'),
                'attr' => ['class' => 'chosen-select chosen-rtl'],
                'multiple' => true
            ]);
            $this->OptionAndPeriod('dooropen_time', trans('Reservation::application.fields.reservation.dooropen_time'), true, true, true, false, false);
            $this->OptionAndPeriod('dooropen_period', trans('Reservation::application.fields.reservation.dooropen_period'), true, true, true, false, false);
            $this->add('apply_info', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => trans('Reservation::application.fields.reservation.apply_info')
            ])
            ->add('apply', 'checkbox', [
                'value' => 1,
                'label' => trans('Reservation::application.fields.reservation.apply'),
                'attr' => ['id' => 'apply']
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
            ])
            ->add('apply_agreement', 'textarea', [
                'label' => trans('Reservation::application.fields.reservation.apply_agreement')
            ]);
        parent::buildForm();
    }
    protected function getGroupAge(){
        return array(
            'null' => 'غير معيّن',
            '3_11' => 'سن من ٣ إلى ١١',
            '12_17' => 'من سن ١٢ إلى ١٧',
            '18_up' => 'من ١٨ فيما فوق'
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
    protected function sortBy($field, &$array, $direction = 'asc')
    {
        usort($array, create_function('$a, $b', '
            $a = $a["' . $field . '"];
            $b = $b["' . $field . '"];

            if ($a == $b)
            {
                return 0;
            }

            return ($a ' . ($direction == 'desc' ? '>' : '<') .' $b) ? -1 : 1;
        '));

        return true;
    }
}