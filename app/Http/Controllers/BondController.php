<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bond\CreateBondRequest;
use App\Http\Requests\Bond\CreateOrderRequest;
use App\Http\Resources\Bond\BondResource;
use App\Services\BondService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BondController extends Controller
{
    /**
     * @param BondService $bondService
     */
    public function __construct(private readonly BondService $bondService)
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

    public function payouts()
    {

    }

    /**
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */
    public function order(CreateOrderRequest $request): JsonResponse
    {
        try {
            return response()->json(new BondResource($this->bondService->createOrder($request)));
        } catch (Exception $exception) {
            Log::error(json_encode(["message" => $exception->getMessage(), "file" => $exception->getFile(), "line" => $exception->getLine()]));
            return response()->json(['message' => "Something went wrong"],500);
        }
    }

    public function orderPayouts()
    {

    }

}
