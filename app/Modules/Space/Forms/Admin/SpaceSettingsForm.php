<?php namespace App\Modules\Space\Forms\Admin;

use App\Base\Forms\AdminForm;
use App\Modules\Organization\Models\Organization;
use App\Modules\Role\Models\Role;
use Auth;
class SpaceSettingsForm extends AdminForm
{
    public function buildForm()
    {
    	 $this
            ->add('equipment', 'textareae', [
                'label' => trans('Space::dashboard.fields.space.space_equipment')
            ]);
         parent::buildForm();
    }
}