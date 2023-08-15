<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bond\CreateBondRequest;
use App\Http\Requests\Bond\GetBondsPayoutsRequest;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\GetOrdersPayoutsRequest;
use App\Http\Resources\Bond\BondResource;
use App\Services\BondService;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BondController extends Controller
{
    /**
     * @param BondService $bondService
     * @param OrderService $orderService
     */
    public function __construct(private readonly BondService $bondService,
                                private readonly OrderService $orderService)
    {
    }

    /**
     * @param CreateBondRequest $request
     * @return JsonResponse
     */
    public function create(CreateBondRequest $request): JsonResponse
    {
        try {
            return response()->json(new BondResource($this->bondService->create($request)));
        } catch (Exception $exception) {
            Log::error(json_encode(["message" => $exception->getMessage(), "file" => $exception->getFile(), "line" => $exception->getLine()]));
            return response()->json(['message' => "Something went wrong"],500);
        }
    }

    public function payouts(GetBondsPayoutsRequest $request): JsonResponse
    {
        try {
            return response()->json(['dates' => $this->bondService->payouts($request)]);
        } catch (Exception $exception) {
            Log::error(json_encode(["message" => $exception->getMessage(), "file" => $exception->getFile(), "line" => $exception->getLine()]));
            return response()->json(['message' => "Something went wrong"],500);
        }
    }

    /**
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */
    public function order(CreateOrderRequest $request): JsonResponse
    {
        try {
            return response()->json(new BondResource($this->orderService->createOrder($request)));
        } catch (Exception $exception) {
            Log::error(json_encode(["message" => $exception->getMessage(), "file" => $exception->getFile(), "line" => $exception->getLine()]));
            return response()->json(['message' => "Something went wrong"],500);
        }
    }

    public function orderPayouts(GetOrdersPayoutsRequest $request): JsonResponse
    {
        try {
            return response()->json($this->orderService->getOrdersPayouts($request));
        } catch (Exception $exception) {
            Log::error(json_encode(["message" => $exception->getMessage(), "file" => $exception->getFile(), "line" => $exception->getLine()]));
            return response()->json(['message' => "Something went wrong"],500);
        }
    }

}
