<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\AdminController;
use App\Http\Requests\Admin\SettingRequest;
use App\Setting;

class SettingController extends AdminController
{
    /**
     * Image column of the model
     *
     * @var string
     */
    private $imageColumn = "logo";

    /**
     * Show the form for editing the settings.
     *
     * @return Response
     */
    public function getSettings()
    {
        $setting = Setting::firstOrFail();
        return $this->getForm($setting);
    }

    /**
     * Update the settings in storage.
     *
     * @param Setting $setting
     * @param SettingRequest $request
     * @return Response
     */
    public function patchSettings(Setting $setting, SettingRequest $request)
    {
        $settings_file = array('space_type' => $this->to_array($request->space_type), 'space_equipment' => $this->to_array($request->space_equipment), 'event_tags' => $this->to_array($request->event_tags));
        file_put_contents(base_path('./resources/settings.bin'), serialize($settings_file));
        unset($request['space_type']);
        unset($request['space_equipment']);
        unset($request['event_tags']);
        return $this->saveFlashRedirect($setting, $request, $this->imageColumn);
    }

    private function to_array($data) {
        $array = array();
        foreach (explode("\n", $data) as $key => $value) {
            $value = explode(" => ", $value);
            $array[$value[0]] = $value[1];
        }
        return $array;
    }
}
