<?php

namespace App\Rules;

use App\Models\Bond;
use Illuminate\Contracts\Validation\Rule;

class CheckOrderDateRule implements Rule
{
    /** @var int $bondId */
    private int $bondId;

    /**
     * Create a new rule instance.
     * @param int $bondId
     */
    public function __construct(int $bondId)
    {
        $this->bondId = $bondId;
    }


    /**
     * @param $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes( $attribute, mixed $value): bool
    {
        $bond = Bond::query()->find($this->bondId);
        return ($bond->issue_date <= $value) && ($bond->last_circulation_date >= $value);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The purchase date cannot be less than the "Issue date" or more than the "Last circulation date".';
    }
}
