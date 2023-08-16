<?php

namespace App\Http\Requests\Bond;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GetBondsPayoutsRequest extends FormRequest
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
            'id' => ['required', 'integer', 'exists:bonds,id']
        ];
    }
    /**
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            "id.exists" => 'No resource found for the selected ID'
        ];
    }
}
