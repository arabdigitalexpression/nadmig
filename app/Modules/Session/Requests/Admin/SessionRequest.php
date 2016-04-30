<?php namespace App\Modules\Session\Requests\Admin;

use App\Http\Requests\Request;

class SessionRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'where' => 'required',
            'address' => 'required',
            'start_time' => 'required',
            'period' => 'required',
            'excerpt' => 'required',
            'description' => 'required',                
        ];
    }
}
