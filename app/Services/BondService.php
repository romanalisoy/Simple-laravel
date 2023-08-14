<?php

namespace App\Services;

use App\Http\Requests\Bond\CreateBondRequest;
use App\Models\Bond;
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
        return Bond::query()->create([
            "issue_date" => $request->get("issue_date"),
            "last_circulation_date" => $request->get("last_circulation_date"),
            "price" => $request->get("price"),
            "payment_frequency" => $request->get("payment_frequency"),
            "calculation_period" => $request->get("calculation_period"),
            "coupon_rate" => $request->get("coupon_rate")
        ]);
    }
}
