<?php namespace App\Modules\Report\Requests\Admin;

use App\Http\Requests\Request;

class ReportRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required',
            'language_id' => 'required|integer',
            'title' => 'required|min:3'
        ];
    }
}
