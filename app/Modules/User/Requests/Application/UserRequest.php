<?php namespace App\Modules\User\Requests\Application;

use App\Http\Requests\Request;

class UserRequest extends Request {

     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        if(Request::isMethod('post')){
            return [
                'email'     => 'required|email|min:6|unique:users,email,'.$this->segment(3),
                'name'      => 'required|min:3',
                'password'  => 'required|confirmed|min:6|max:20',
                'picture'   => 'sometimes|max:2048|image'
            ];
        }
        if(Request::isMethod('patch')){
            return [
                'name'      => 'required|min:3',
                'password'  => 'sometimes|confirmed|min:6|max:20',
                'picture'   => 'sometimes|max:2048|image'
            ];
        }
    }
}
