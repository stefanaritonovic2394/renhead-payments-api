<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTravelPaymentRequest;
use App\Http\Requests\UpdateTravelPaymentRequest;
use App\Http\Resources\TravelPaymentCollection;
use App\Http\Resources\TravelPaymentResource;
use App\Models\TravelPayment;
use Illuminate\Http\Response;

class TravelPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TravelPaymentCollection
     */
    public function index(): TravelPaymentCollection
    {
        $travelPayment = TravelPayment::with(['user'])->latest()->paginate();
        return new TravelPaymentCollection($travelPayment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTravelPaymentRequest $request
     * @return TravelPaymentResource
     */
    public function store(StoreTravelPaymentRequest $request): TravelPaymentResource
    {
        $travelPayment = TravelPayment::create($request->validated());
        return new TravelPaymentResource($travelPayment);
    }

    /**
     * Display the specified resource.
     *
     * @param TravelPayment $travelPayment
     * @return TravelPaymentResource
     */
    public function show(TravelPayment $travelPayment): TravelPaymentResource
    {
        return new TravelPaymentResource($travelPayment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTravelPaymentRequest $request
     * @param TravelPayment $travelPayment
     * @return Response
     */
    public function update(UpdateTravelPaymentRequest $request, TravelPayment $travelPayment): TravelPaymentResource
    {
        $travelPayment->update($request->validated());
        return new TravelPaymentResource($travelPayment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy(int $id): array
    {
        $travelPayment = TravelPayment::find($id);
        $travelPayment->delete();

        return ['message' => 'Travel payment deleted'];
    }
}
