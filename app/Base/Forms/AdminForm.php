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
            ])
            ->add('clear', 'reset', [
                'label' => trans('dashboard.fields.reset'),
                'attr' => ['class' => 'btn btn-warning']
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

}
