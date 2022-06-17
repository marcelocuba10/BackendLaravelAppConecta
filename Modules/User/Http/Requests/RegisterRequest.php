<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20|min:5|',
            'company' => 'required|max:20|min:5|',
            'email' => 'required|unique:users,email',
            'password' => 'required|max:20|min:5|',
            'confirm_password' => 'required|max:20|min:5|same:password',
            'terms' => 'required|max:1|min:1'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
