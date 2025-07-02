<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_countries');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $country = request()->route('country');

        return [
            "name_ar" => ["required", "string:255", "regex:/^[ء-ي]+/", Rule::unique('countries')->ignore($country->id)],
            "name_en" => ["required", "string:255", "regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/", Rule::unique('countries')->ignore($country->id)],
        ];
    }
}
