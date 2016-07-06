<?php namespace App\Modules\Report\Forms\Admin;

use App\Base\Forms\AdminForm;

class LikeDislikeReportsForm extends AdminForm
{
    public function buildForm()
    {
        $this
	        ->add('like', 'textarea', [
	            'label' => 'أعجبني'
	        ])
	        ->add('dislike', 'textarea', [
	            'label' => 'لم يعجبني'
	        ])
            ->add('need_to_enhance', 'textarea', [
                'label' => 'يحتاج لتحسين'
            ]);
        parent::buildForm();
    }
}
