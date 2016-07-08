<?php namespace App\Modules\Trainer\Requests\Application;

use App\Http\Requests\Request;

class TrainerRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bio'   => 'sometimes',
            'specialization'   => 'sometimes'
        ];
    }
}
