<?php

namespace App\Forms\Admin;

use App\Base\Forms\AdminForm;

class SettingsForm extends AdminForm
{
    public function buildForm()
    {
        $settings = include base_path('./resources/settings.php');
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
            // ->add('space', 'static', [
            //     'label' => false,
            //     'tag' => 'div',
            //     'attr' => ['class' => 'page-header'],
            //     'value' => trans('dashboard.fields.setting.space')
            // ])
            // ->add('space_equipment', 'textarea', [
            //     'label' => trans('dashboard.fields.setting.space_equipment'),
            //     'value' => implode(" ",$settings['space_equipment'])
            // ])
            // ->add('space_type', 'textarea', [
            //     'label' => trans('dashboard.fields.setting.space_type'),
            //     'value' => implode("\n",$settings['space_type'])
            // ])
            // ->add('event_tags', 'textarea', [
            //     'label' => trans('dashboard.fields.setting.event_tags'),
            //     'value' => implode(" ",$settings['event_tags'])
            // ]);
        parent::buildForm();
    }
}
