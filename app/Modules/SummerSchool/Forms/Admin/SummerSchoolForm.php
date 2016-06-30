<?php namespace App\Modules\SummerSchool\Forms\Admin;

use App\Base\Forms\AdminForm;

class SummerSchoolForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('SummerSchool::admin.fields.summerschool.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('SummerSchool::admin.fields.summerschool.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('SummerSchool::admin.fields.summerschool.content')
            ]);
        parent::buildForm();
    }
}
