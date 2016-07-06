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
            'like' => 'required',
            'dislike' => 'required',
            'need_to_enhance' => 'sometimes'
        ];
    }
}
