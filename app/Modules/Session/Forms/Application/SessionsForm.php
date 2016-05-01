<?php namespace App\Modules\Session\Forms\Application;

use App\Base\Forms\AdminForm;

class SessionsForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('where', 'text', [
                'label' => trans('Session::dashboard.fields.session.where')
            ])
            ->add('address', 'text', [
                'label' => trans('Session::dashboard.fields.session.address')
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
}
