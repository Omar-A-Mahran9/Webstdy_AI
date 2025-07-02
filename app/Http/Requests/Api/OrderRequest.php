<?php

namespace App\Http\Requests\Api;

 use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use App\Rules\TwoWords;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;

    }


 public function rules(): array
{
    $currentStep = request()->route('step');

    // Define validation rules for each step
    $stepsRules = [
        1 => [
            "name" => ['required', 'string', 'max:255', new NotNumbersOnly(), new TwoWords() // Ensures at least two words
        ],
            "email" => ['nullable', 'email'],
            "child_name" => ['required', 'string', 'max:255'],
            "phone" => [
                'required',
                'string',
                'max:20',
                new PhoneNumber(),
            ],
            "birth_date_of_child" => ['required', 'date'],
        ],
        2 => [
            "phone" => [
                'required',
                'string',
                'max:20',
                new PhoneNumber(),
            ],
            "email" => ['nullable', 'email'],

            "otp" => ['required', 'numeric', 'digits:4'], // Adjust digits as per requirement
        ],
        3 => [
            "email" => ['nullable', 'email'],
            "phone" => [
                'required',
                'string',
                'max:20',
                new PhoneNumber(),
            ],
            'Choose_duration_later' => ['required', 'boolean'],
            'package_id' => ['required', 'numeric', 'exists:packages,id'],
            'price' => [ 'numeric', 'exists:packages,id'],

            'group_id' => ['required_if:Choose_duration_later,0', 'numeric', 'exists:groups,id'],
            'day_id' => ['required_if:Choose_duration_later,0', 'numeric', 'exists:days,id'],
            'time_id' => ['required_if:Choose_duration_later,0', 'numeric', 'exists:times,id'],
            'customer_id' => [ 'numeric', 'exists:customers,id'],

                ],
    ];

    // Validate step existence
    if (!array_key_exists($currentStep, $stepsRules)) {
        abort(400, __('Invalid step provided.'));
    }

    // Return validation rules for the current step
    return $stepsRules[$currentStep];
}

}
