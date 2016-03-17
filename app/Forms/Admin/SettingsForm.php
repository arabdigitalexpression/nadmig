<?php

namespace App\Forms\Admin;

use App\Base\Forms\AdminForm;

class SettingsForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('email', 'text', [
                'label' => trans('dashboard.fields.setting.email')
            ])
            ->add('facebook', 'text', [
                'label' => trans('dashboard.fields.setting.facebook')
            ])
            ->add('twitter', 'text', [
                'label' => trans('dashboard.fields.setting.twitter')
            ])
            ->add('analytics_id', 'text', [
                'label' => trans('dashboard.fields.setting.analytics_id')
            ])
            ->add('disqus_shortname', 'text', [
                'label' => trans('dashboard.fields.setting.disqus_shortname')
            ])
            ->add('logo', 'file', [
                'label' => trans('dashboard.fields.setting.logo'),
                'attr' => ['class' => '']
            ]);
        parent::buildForm();
    }
}
