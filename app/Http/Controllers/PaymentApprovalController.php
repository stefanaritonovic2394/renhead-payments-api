<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentApprovalRequest;
use App\Http\Resources\PaymentApprovalResource;
use App\Models\PaymentApproval;
use Illuminate\Http\Request;

class PaymentApprovalController extends Controller
{
    /**
     * Store payment approval
     *
     * @param StorePaymentApprovalRequest $request
     * @return PaymentApprovalResource
     */
    public function storePaymentApproval(StorePaymentApprovalRequest $request): PaymentApprovalResource
    {
        $paymentApproval = PaymentApproval::create($request->validated());
        return new PaymentApprovalResource($paymentApproval);
    }

    /**
     * Approve a payment.
     *
     * @param $paymentId
     * @return array
     */
    public function approvePayment($paymentId): array
    {
        PaymentApproval::where('payment_id', '=', $paymentId)->update([
            'status' => 'APPROVED',
        ]);

        return ['message' => 'Payment approved'];
    }
}
