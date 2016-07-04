<?php namespace App\Modules\Report\Requests\Admin;

use App\Http\Requests\Request;

class SpaceManager2ReportRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required',
            'session_id' => 'required|integer',
            'date' => 'required|date',
            'attendees' => 'required',
            'notes' => 'required',
        ];
    }
}
