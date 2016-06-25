<?php namespace App\Modules\Apply\Forms\Admin;

use App\Base\Forms\AdminForm;

class ApplyForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Apply::admin.fields.apply.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Apply::admin.fields.apply.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Apply::admin.fields.apply.content')
            ]);
        parent::buildForm();
    }
}
