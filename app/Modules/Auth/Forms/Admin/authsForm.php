<?php namespace App\Modules\Auth\Forms\Admin;

use App\Base\Forms\AdminForm;

class authsForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Auth::dashboard.fields.auth.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Auth::dashboard.fields.auth.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Auth::dashboard.fields.auth.content')
            ]);
        parent::buildForm();
    }
}
