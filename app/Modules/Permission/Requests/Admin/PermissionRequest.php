<?php namespace App\Modules\Permission\Requests\Admin;

use App\Http\Requests\Request;

class PermissionRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return [
            'name'      => 'required|min:3',
            'display_name'  => 'required|min:3|max:20',
            'description'  => 'required|min:6|max:100',
        ];
    }
}
