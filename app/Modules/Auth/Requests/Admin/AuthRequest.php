<?php namespace App\Modules\Auth\Requests\Admin;

use App\Http\Requests\Request;

class AuthRequest extends Request {

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
