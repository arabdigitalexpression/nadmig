<?php namespace App\Modules\Session\Forms\Application;

use App\Base\Forms\AdminForm;

class SessionsForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden', [
                'attr' => ['id' => 'id']
            ])
            ->add('space_id', 'choice', [
                'choices' => $this->getSpaces(),
                'selected' => $this->space_id,
                'attr' => ['id' => 'space_select'],
                'label' => trans('Session::application.fields.session.where') . '<a class="agreement" href="#" data-toggle="popover" title=" قواعد و شروط و توجيهات الاستغلال" data-content=""><i class="fa fa-info-circle" aria-hidden="true"></i></a><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="font-size:12px; display:none;"></i>'
            ])
            ->add('start_time[date]', 'text', [
                'label' => trans('Session::application.fields.session.start_time_date'),
                'attr' => ['id' => 'start_date'],
                'value' => function ($name) {
                    return $name;
                }
            ])
            ->add('start_time[time]', 'text', [
                'label' => trans('Session::application.fields.session.start_time_time'),
                'attr' => ['id' => 'start_time'],
                'value' => function ($start_time) {
                    return $start_time;
                }
            ])
            ->add('fees', 'number', [
                'attr' => ['id' => 'fees'],
                'label' => trans('Reservation::application.fields.reservation.fees') . '<span class="fees"></span>'
            ]);
            $this->OptionAndPeriod('period', trans('Session::dashboard.fields.session.period'), false);
            $this->add('excerpt', 'textarea', [
                'label' => trans('Reservation::application.fields.reservation.excerpt'),
                'attr' => ['id' => 'excerpt']
            ])
            ->add('description', 'textarea', [
                'label' => trans('Reservation::application.fields.reservation.description'),
                'attr' => ['id' => 'description']
            ]);
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
    protected function getSpaces(){
        $array = array();
        foreach ($this->data[0]->spaces->toArray() as $space)
        {    
            $array = array_add($array, $space['id'], $space['name']);   
        }
        return $array;
    }
}
