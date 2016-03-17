<?php

namespace App\Forms\Admin;

use App\Base\Forms\AdminForm;

class PagesForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('language_id', 'choice', [
                'choices' => $this->data,
                'label' => trans('dashboard.fields.page.language_id')
            ])
            ->add('title', 'text', [
                'label' => trans('dashboard.fields.page.title')
            ])
            ->add('content', 'textarea', [
                'label' => trans('dashboard.fields.page.content')
            ])
            ->add('description', 'text', [
                'label' => trans('dashboard.fields.page.description')
            ]);
        parent::buildForm();
    }
}
