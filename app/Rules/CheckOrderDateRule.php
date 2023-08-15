<?php

namespace App\Rules;

use App\Models\Bond;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class CheckOrderDateRule implements Rule
{
    /**
     * @var int $bondId
     */
    private int $bondId;

    /**
     * Create a new rule instance.
     * @param int $bondId
     */
    public function __construct(int $bondId)
    {
        $this->bondId = $bondId;
    }


    public function passes( $attribute, mixed $value): bool
    {
        $bond = Bond::query()->find($this->bondId);
        info($bond);
        info($attribute);
        info($value);
        return ($bond->issue_date <= $value) or ($bond->last_circulation_date >= $value);
    }

    public function message()
    {
        // TODO: Implement message() method.
    }
}
