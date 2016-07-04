<?php namespace App\Modules\Report\Forms\Application;

use App\Base\Forms\AdminForm;

class TrainerReportForm extends AdminForm
{
    public function buildForm()
    {
        $this ->add('info', 'static', [

                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => 'الشق القيمي'
            ]);
        $this->question('confidence', 'الثقة في النفس');
        $this->question('initiative', 'الأخذ بالمبادرة');
        $this->question('respect_and_accept', 'احترام وتقبل رأي الأخر');
        $this->question('team_work', 'القدرة على العمل الجماعي');
        $this->question('critical_thinking', 'التفكير النقدي');
        $this->question('imagination', 'القدرة على الخيال');
        $this->question('open_to_change', 'منفتح على التغــُير والتغيير ');
        $this ->add('info_1', 'static', [
                'label' => false,
                'tag' => 'div',
                'attr' => ['class' => 'page-header'],
                'value' => 'الشق المعرفي والمهاري'
            ]);
        $this->question('ability_to_understand_the_content', 'القدرة على فهم المحتوى');
        $this->question('ability_to_produce_art', 'القدرة على انتاج عمل فني');
        $this->question('ability_to_thinking', 'القدرة على التحليل');
        $this->question('ability_to_inovate', 'القدرة على الابتكار');
        parent::buildForm();
    }
    protected function question($name, $title){
        $this
            ->add($name . '[percentage]', 'choice', [
                'choices' => [ 1 => 'بنسبة ضعيفة', 2 => 'بنسبة متوسطة', 3 => 'بنسبة كبيرة' ],
                'selected' => $this->{$name},
                'label' => $title,
                'attr' => ['id' => $name . '_type']
            ])
            ->add($name . '[text]', 'textarea', [
                'label' => 'دليل على الفعل',
                'value' => function ($name) {
                    return $name;
                },
                'attr' => ['id' => $name . '_type']
            ]);
    }

}
