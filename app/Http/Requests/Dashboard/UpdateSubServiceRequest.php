<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('sub_services');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

           return [
            'is_publish' => ['nullable', 'boolean'],
            "name_ar" => ["required", "max:255", new NotNumbersOnly(), "unique:services,name_ar"],
            "name_en" => ["required", "max:255", new NotNumbersOnly(), "unique:services,name_en"],
            "service_id" => ["required" ],
            "tool_id" => ["required" ],

            "description_ar" => ["required", new NotNumbersOnly() ],
            "description_en" => ["required", new NotNumbersOnly() ],
             ];
    }
}
