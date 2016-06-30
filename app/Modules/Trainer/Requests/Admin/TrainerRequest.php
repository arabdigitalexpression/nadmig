<?php namespace App\Modules\Trainer\Requests\Admin;

use App\Http\Requests\Request;

class TrainerRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'bio'   => 'sometimes',
            'specialization'   => 'sometimes',
            'number_workshops'   => 'sometimes'
        ];
    }
}
