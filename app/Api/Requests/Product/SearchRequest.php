<?php

namespace App\Api\Requests\Product;

use Dingo\Api\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules()
    {
        return config('access.search.product');
    }

    public function authorize()
    {
        return true;
    }
}
