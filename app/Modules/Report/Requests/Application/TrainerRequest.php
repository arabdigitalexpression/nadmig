<?php namespace App\Modules\Report\Requests\Application;

use App\Http\Requests\Request;

class TrainerRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'confidence' => 'required',
            'initiative' => 'required',
            'respect_and_accept' => 'required',
            'team_work' => 'required',
            'critical_thinking' => 'required',
            'imagination' => 'required',
            'open_to_change' => 'required',
            'ability_to_understand_the_content' => 'required',
            'ability_to_produce_art' => 'required',
            'ability_to_thinking' => 'required',
            'ability_to_inovate' => 'required',
        ];
    }
}
