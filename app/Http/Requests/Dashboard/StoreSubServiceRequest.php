<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_sub_services');
    }

    public function rules()
    {
        return [
            'is_publish' => ['nullable', 'boolean'],
            "name_ar" => ["required", "max:255", new NotNumbersOnly(), "unique:sub_services,name_ar"],
            "name_en" => ["required", "max:255", new NotNumbersOnly(), "unique:sub_services,name_en"],
            "service_id" => ["required" ],
            "tool_id" => ["required" ],

            "description_ar" => ["required", new NotNumbersOnly() ],
            "description_en" => ["required", new NotNumbersOnly() ],
             ];
    }
}
