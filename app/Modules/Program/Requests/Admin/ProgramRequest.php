<?php namespace App\Modules\Program\Requests\Admin;

use App\Http\Requests\Request;

class ProgramRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'artwork' => 'sometimes', 
            'description' => 'required|min:10',
            'events' => 'required'
        ];
    }
}
