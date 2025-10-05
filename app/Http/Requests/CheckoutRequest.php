<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'adder.billing.first_name' => ['required', 'string', 'max:255'],
        'adder.billing.last_name' => ['required', 'string', 'max:255'],
        'adder.billing.email' => ['required', 'email', 'max:255'],
        'adder.billing.phone_number' => ['required', 'string', 'max:20'],
        'adder.billing.street_address' => ['required', 'string', 'max:255'],
        'adder.billing.city' => ['required', 'string', 'max:100'],
        'adder.billing.postal_code' => ['required', 'string', 'max:20'],
        'adder.billing.state' => ['required', 'string', 'max:100'],
        'adder.billing.country' => ['required', 'string', 'max:100'],

        'adder.shipping.first_name' => ['required', 'string', 'max:255'],
        'adder.shipping.last_name' => ['required', 'string', 'max:255'],
        'adder.shipping.email' => ['required', 'email', 'max:255'],
        'adder.shipping.phone_number' => ['required', 'string', 'max:20'],
        'adder.shipping.street_address' => ['required', 'string', 'max:255'],
        'adder.shipping.city' => ['required', 'string', 'max:100'],
        'adder.shipping.postal_code' => ['required', 'string', 'max:20'],
        'adder.shipping.state' => ['required', 'string', 'max:100'],
        'adder.shipping.country' => ['required', 'string', 'max:100'],
        ];
    }
}
