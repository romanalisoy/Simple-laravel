<?php

namespace App\Services;

use App\Http\Requests\Bond\CreateBondRequest;
use App\Http\Requests\Bond\GetBondsPayoutsRequest;
use App\Models\Bond;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BondService
{
    /**
     * @param CreateBondRequest $request
     * @return Model|Builder
     */
    public function create(CreateBondRequest $request): Model|Builder
    {
        return Bond::query()->create($request->toService());
    }

    /**
     * @param GetBondsPayoutsRequest $request
     * @return array|array[]
     */
    public function payouts(GetBondsPayoutsRequest $request): array
    {
        $dates = $this->getPayoutDates(Bond::findOrFail($request->get('id')));

        return array_map(function ($date) {
                return ['date' => $date];
            }, $dates);
    }

    /**
     * @param Bond $bond
     * @return array
     */
    private function getPayoutDates(Bond $bond): array
    {
        $periodDays = match ($bond->calculation_period) {
            360 => 12 / $bond->payment_frequency * 30,
            364 => 364 / $bond->payment_frequency,
            365 => 12 / $bond->payment_frequency,
            default => 30,
        };

        $dates = [];
        $currentDate = Carbon::parse($bond->issue_date);

        while ($currentDate <= Carbon::parse($bond->last_circulation_date)) {
            if ($currentDate->dayOfWeek == CarbonInterface::SATURDAY || $currentDate->dayOfWeek == CarbonInterface::SUNDAY) {
                $currentDate->modify('next monday');
            }
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDays($periodDays);
        }

        return $dates;
    }

}
