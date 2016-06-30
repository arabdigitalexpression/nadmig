<?php namespace App\Modules\School\Requests\Admin;

use App\Http\Requests\Request;

class SchoolRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'organization_id' => 'required|integer',
            'program_id' => 'required|integer'
        ];
    }
}
