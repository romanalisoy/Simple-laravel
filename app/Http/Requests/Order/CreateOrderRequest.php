<?php

namespace App\Http\Requests\Order;

use App\Rules\CheckOrderDateRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            "bond_id" => ['required', 'integer', 'exists:bonds,id'],
            "order_date" => ['required', 'date', new CheckOrderDateRule($this->bond_id)],
            "purchases_count" => ['required', 'integer', 'gt:0']
        ];
    }

    /**
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge(['bond_id' => (int)$this->route('id')]);
    }

    public function toService(): array
    {
        return [
            'bond_id' => $this->bond_id,
            'order_date' => $this->get('order_date'),
            'purchases_count' => $this->get('purchases_count'),
        ];
    }
}
