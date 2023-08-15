<?php

namespace App\Http\Requests\Bond;

use App\Constants\BondConstant;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBondRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "issue_date" => ['required', 'date', 'after_or_equal:today'],
            "last_circulation_date" => ['required', 'date', 'after:issue_date'],
            "price" => ['required', 'numeric', 'gt:0'],
            "payment_frequency" => ['required', 'integer', Rule::in(BondConstant::PAYMENT_FREQUENCY)],
            "calculation_period" => ['required', 'integer', Rule::in(BondConstant::CALCULATION_PERIOD)],
            "coupon_rate" => ['required', 'numeric', 'gt:0'],
        ];
    }


    /**
     * @return array
     */
    public function toService(): array
    {
        return [
            "issue_date" => $this->get("issue_date"),
            "last_circulation_date" => $this->get("last_circulation_date"),
            "price" => $this->get("price"),
            "payment_frequency" => (string)$this->get("payment_frequency"),
            "calculation_period" => (string)$this->get("calculation_period"),
            "coupon_rate" => $this->get("coupon_rate")
        ];
    }


}
