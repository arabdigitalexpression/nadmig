<?php namespace App\Modules\Event\Forms\Admin;

use App\Base\Forms\AdminForm;

class EventForm extends AdminForm
{
    public function buildForm()
    {
        $this
		        ->add('language_id', 'choice', [
		            'choices' => $this->data,
		            'label' => trans('Event::admin.fields.event.language_id')
		        ])
		        ->add('title', 'text', [
		            'label' => trans('Event::admin.fields.event.title')
		        ])
            ->add('content', 'textarea', [
                'label' => trans('Event::admin.fields.event.content')
            ]);
        parent::buildForm();
    }
}
