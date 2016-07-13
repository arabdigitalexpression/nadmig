<?php namespace App\Modules\Report\Forms\Admin;

use App\Base\Forms\AdminForm;

class Report8ReportsForm extends AdminForm
{
    public function buildForm()
    {
        $this
	        ->add('what_happens', 'textarea', [
	            'label' => 'أعجبني'
	        ])
	        ->add('notes', 'textarea', [
	            'label' => 'لم يعجبني'
	        ]);
            $this->question('does_it_achive_the_goal', 'تمت أهداف التدريب بشكل كامل');
            $this->question('trainer_explaination_intraction', 'طريقة شرح المدرب تفاعلية');
            $this->question('trainer_answers', 'طريقة اجابة المدرب على الأسئلة كانت واضحة');
            $this->question('trainer_intraction', 'كان المتدريبن متفاعلين مع الأنشطة');
            $this->question('workshop_overall', 'التدريب بشكل عام كان مفيد');
        parent::buildForm();
    }
    protected function question($name, $title){
        $this
            ->add($name . '[percentage]', 'choice', [
                'choices' => [ 'أوافق بشدة' => 'أوافق بشدة', 'أوافق' => 'أوافق', 'محايد' => 'محايد', 'لاأوافق' => 'لاأوافق', 'لا أوافق بشدة' => 'لا أوافق بشدة' ],
                'selected' => $this->{$name},
                'label' => $title,
                'attr' => ['id' => $name . '_type']
            ]);
    }
}
