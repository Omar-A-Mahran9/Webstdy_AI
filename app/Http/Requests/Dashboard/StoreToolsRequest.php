<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreToolsRequest extends FormRequest
{

    public function authorize()
    {
        return abilities()->contains('create_tools');
    }


    public function rules()
    {

        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            "name_ar" => ["required", "string:255", "unique:tools", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "unique:tools", new NotNumbersOnly()],

        ];
    }
}
