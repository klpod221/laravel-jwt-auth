<?php

namespace App\Api\Requests\Auth;

use App\Models\User;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:6|max:191',
            'email' => 'required|string|email',
            'phone' => ['required', 'string', config('const.rule.phone')],
            'password' => ['required', 'string', config('const.rule.password')],
            'birthday' => config('const.rule.date'),
            'gender' => Rule::in(array_keys(config('option.gender'))),
            'marital' => Rule::in(array_keys(config('option.marital'))),
            'type' => ['required', Rule::in([User::TYPE_CANDIDATE])],
            'address.province_id' => 'numeric',
            'address.district_id' => 'numeric',
            'address.ward_id' => 'numeric',
            'address.street_id' => 'numeric',
            'address.detail' => 'string|min:3'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
