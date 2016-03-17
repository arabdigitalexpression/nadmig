<?php

namespace App\Forms\Admin;

use App\Base\Forms\AdminForm;

class LanguagesForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'label' => trans('dashboard.fields.language.title')
            ])
            ->add('code', 'text', [
                'label' => trans('dashboard.fields.language.code')
            ])
            ->add('site_title', 'text', [
                'label' => trans('dashboard.fields.language.site_title')
            ])
            ->add('site_description', 'text', [
                'label' => trans('dashboard.fields.language.site_description')
            ])
            ->add('flag', 'file', [
                'label' => trans('dashboard.fields.language.flag'),
                'attr' => ['class' => '']
            ]);
        parent::buildForm();
    }
}
