<?php namespace App\Modules\Session\Forms\Admin;

use App\Base\Forms\AdminForm;

class SessionForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Session::admin.fields.session.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Session::admin.fields.session.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Session::admin.fields.session.content')
            ]);
        parent::buildForm();
    }
}
