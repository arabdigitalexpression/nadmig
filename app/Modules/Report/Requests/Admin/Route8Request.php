<?php namespace App\Modules\Report\Requests\Admin;

use App\Http\Requests\Request;

class LikeDislikeReportRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'what_happens' => 'required',
            'notes' => 'required',
            'does_it_achive_the_goal' => 'required',
            'trainer_explaination_intraction' => 'required',
            'trainer_answers' => 'required',
            'trainer_intraction' => 'required',
            'workshop_overall' => 'required',
        ];
    }
}
