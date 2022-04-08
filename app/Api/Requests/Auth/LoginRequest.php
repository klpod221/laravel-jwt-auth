<?php

namespace App\Api\Requests\Auth;

use Dingo\Api\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return config('access.login.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
