<?php namespace App\Modules\Report\Forms\Admin;

use App\Base\Forms\AdminForm;

class ReportsForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Report::admin.fields.report.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Report::admin.fields.report.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Report::admin.fields.report.content')
            ]);
        parent::buildForm();
    }
}
