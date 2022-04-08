<?php

namespace App\Api\Requests\Product;

use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Product;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'numeric',
            'name' => 'required|min:6|max:' . config('const.default_string_length'),
            'files' => 'nullable|file|max:5120|mimes:jpeg,png,jpg',
            'status' => ['required', Rule::in(Product::STATUS_WAIT_ACTIVATION, Product::STATUS_ACTIVATED)]
        ];
    }

    public function authorize()
    {
        return true;
    }
}
