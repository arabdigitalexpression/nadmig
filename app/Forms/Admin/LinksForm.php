<?php

namespace App\Forms\Admin;

use App\Base\Forms\AdminForm;

class LinksForm extends AdminForm
{
    public function buildForm()
    {
        $this
            ->add('type', 'choice', [
                'choices' => ['website' => trans('dashboard.fields.link.type.website'), 'facebook' => trans('dashboard.fields.link.type.facebook'),'twitter' => trans('dashboard.fields.link.type.twitter'),'instagram' => trans('dashboard.fields.link.type.instagram')],
                'selected' => $this->manager_id,
                'label' => trans('dashboard.fields.link.type.title'),
                'attr' => ['id' => 'type']
            ])
            ->add('link', 'text', [
                'label' => trans('dashboard.fields.link.title'),
                'attr' => ['id' => 'link']
            ]);
    }
}
