<?php

namespace App\Forms\Admin;

use App\Base\Forms\AdminForm;

class PagesForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('language_id', 'hidden', [
                'value' => 1
            ])
            ->add('title', 'text', [
                'label' => trans('dashboard.fields.page.title')
            ])
            ->add('content', 'textarea', [
                'label' => trans('dashboard.fields.page.content')
            ]);
            // ->add('description', 'text', [
            //     'label' => trans('dashboard.fields.page.description')
            // ]);
        parent::buildForm();
    }
}
