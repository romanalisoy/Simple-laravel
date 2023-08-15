<?php

namespace App\Services;

use App\Http\Requests\Bond\CreateBondRequest;
use App\Http\Requests\Bond\CreateOrderRequest;
use App\Models\Bond;
use App\Models\Order;
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
     * @param CreateOrderRequest $request
     * @return Model|Builder
     */
    public function createOrder(CreateOrderRequest $request): Model|Builder
    {
        return Order::query()->create($request->toService());
    }
}
