<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PaymentCollection
     */
    public function index(): PaymentCollection
    {
        $payment = Payment::with(['user'])->latest()->paginate();
        return new PaymentCollection($payment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePaymentRequest $request
     * @return PaymentResource
     */
    public function store(StorePaymentRequest $request): PaymentResource
    {
        $payment = Payment::create($request->validated());
        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param Payment $payment
     * @return PaymentResource
     */
    public function show(Payment $payment): PaymentResource
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePaymentRequest $request
     * @param Payment $payment
     * @return PaymentResource
     */
    public function update(UpdatePaymentRequest $request, Payment $payment): PaymentResource
    {
        $payment->update($request->validated());
        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy(int $id): array
    {
        $payment = Payment::find($id);
        $payment->delete();

        return ['message' => 'Payment deleted'];
    }
}
