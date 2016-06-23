<?php

namespace App\Base\Forms;

use Kris\LaravelFormBuilder\Form;

abstract class AdminForm extends Form
{
    public function buildForm()
    {
        $this->addButtons();
    }

    protected function addButtons()
    {
        $this
            ->add('save', 'submit', [
                'label' => trans('dashboard.fields.save'),
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }
    protected function getGovernorates(){
        return array(
                'alexandria' => 'الإسكندرية',
                'ismailia' => 'الإسماعيلية',
		        'aswan' => 'أسوان',
                'asyut' => 'أسيوط',
                'luxor' => 'الأقصر',
                'red_sea' => 'البحر الأحمر',
                'beheira' => 'البحيرة',
                'beni_suef' => 'بني سويف',
                'port_said' => 'بورسعيد',
                'south_sinai' => 'جنوب سيناء',
                'giza' => 'الجيزة',
                'dakahlia' => 'الدقهلية',
                'damietta' => 'دمياط',
                'sohag' => 'سوهاج',
                'suez' => 'السويس',
                'sharqia' => 'الشرقية',
                'north_sinai' => 'شمال سيناء',
                'gharbia' => 'الغربية',
                'faiyum' => 'الفيوم',
                'cairo' => 'القاهرة',
                'qalyubia' => 'القليوبية',
                'qena' => 'قنا',
                'kafr_el_sheikh' => 'كفر الشيخ',
                'matruh' => 'مطروح',
                'monufia' => 'المنوفية',
                'minya' => 'المنيا',
                'new_valley' => 'الوادي الجديد'
            );
    }
    protected function getWeekdays(){
        return array(
            "sat" => "السبت",
            "sun" => "الاحد",
            "mon" => "الاثنين",
            "tue" => "الثلاثاء",
            "wed" => "الاربعاء",      
            "thu" => "الخميس",
            "fri" => "الجمعة"
            );
    }
    protected function getYesOrNo(){
        return array(
            "yes" => "نعم",
            "no" => "لا"
            );
    }
    protected function getReservationType($isNull, $isMin,$isHours, $isDays){
        $array = array();
        if ($isNull) {
            $array['null'] = "لا يوجد";
        };
        if ($isMin) {
            $array['mins'] = "دقائق";
        };
        if ($isHours) {
            $array['hours'] = "ساعات";
        }
        if ($isDays) {
            $array['days'] = "أيام";
        }
        return $array;
    }
    protected function OptionAndPeriod($name, $title, $isNull = true, $isMin = false, $isHours = false, $isDays = true, $isSelect = true){
        
        if ($isNull) {
            $type = 'hidden';
        }else{
            $type = 'number';
        }
        if($isSelect){
            $attr = ['id' => $name . '_period', 'class' => 'space_number'];
        }else{
            $attr = ['id' => $name . '_period'];
        }
        $this
            ->add($name . '[type]', 'choice', [
                'choices' => $this->getReservationType($isNull, $isMin,$isHours, $isDays),
                'selected' => $this->{$name},
                'label' => $title,
                'expanded' => $isSelect,
                'attr' => ['id' => $name . '_type']
            ])
            ->add($name . '[period]', $type, [
                'wrapper' => ['class' => 'period_val'],
                'label' => false,
                'value' => function ($name) {
                    return $name;
                },
                'attr' => $attr
            ]);
    }
    protected function getChangeFeesKeys(){
        return array(
                "null" => "لا يوجد",
                "percentage" => "نسبة من قيمة الحجز",
                "value" => "قيمة"
            );
    }

}
