<?php namespace App\Modules\Trainer\Forms\Admin;

use App\Base\Forms\AdminForm;

class TrainerForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Trainer::admin.fields.trainer.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Trainer::admin.fields.trainer.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Trainer::admin.fields.trainer.content')
            ]);
        parent::buildForm();
    }
}
