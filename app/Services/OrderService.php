<?php

namespace App\Services;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\GetOrdersPayoutsRequest;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderService
{
    /**
     * @param CreateOrderRequest $request
     * @return Model|Builder
     */
    public function createOrder(CreateOrderRequest $request): Model|Builder
    {
        return Order::query()->create($request->toService());
    }

    /**
     * @param GetOrdersPayoutsRequest $request
     * @return array
     */
    public function getOrdersPayouts(GetOrdersPayoutsRequest $request): array
    {
        $order = Order::with('bond')->findOrFail($request->get('id'));
        $bond = $order->bond;

        $paymentFrequencyDays = $order->bond->calculation_period / $order->bond->payment_frequency;

        $interestDates = $this->calculateInterestDates($order->bond->issue_date, $order->bond->last_circulation_date, $paymentFrequencyDays);

        $interestPayments = [];
        $previousDate = $order->order_date;

        foreach ($interestDates as $interestDate) {
            if ($previousDate < $interestDate) {
                $elapsedDays = $interestDate->diffInDays($previousDate);

                $accumulatedInterest = ($order->bond->price / 100 * $order->bond->coupon_rate) / $order->bond->payment_frequency * $elapsedDays * $order->purchases_count;
                $date = clone($interestDate);

                if ($interestDate->dayOfWeek == CarbonInterface::SUNDAY || $interestDate->dayOfWeek == CarbonInterface::SATURDAY) {
                    $date = $date->next(CarbonInterface::MONDAY);
                }

                $interestPayments[] = [
                    'date' => $date->format('Y-m-d'),
                    'amount' => $accumulatedInterest
                ];
                $previousDate = $interestDate;
            }
        }

        return $interestPayments;
    }

    /**
     * @param $start
     * @param $end
     * @param $intervalDays
     * @return array
     */
    protected function calculateInterestDates($start, $end, $intervalDays): array
    {
        $dates = [];
        $currentDate = Carbon::parse($start);
        $end = Carbon::parse($end);

        while ($currentDate <= $end) {
            $dates[] = $currentDate->copy();
            $currentDate->addDays($intervalDays);
        }

        return $dates;

    }
}
