<?php namespace App\Modules\Log\Forms\Admin;

use App\Base\Forms\AdminForm;

class LogForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Log::admin.fields.log.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Log::admin.fields.log.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Log::admin.fields.log.content')
            ]);
        parent::buildForm();
    }
}
