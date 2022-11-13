<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentApprovalRequest;
use App\Http\Resources\PaymentApprovalResource;
use App\Models\PaymentApproval;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('approve-payment');

        PaymentApproval::where('payment_id', '=', $paymentId)->update([
            'status' => 'APPROVED',
        ]);

        return ['message' => 'Payment approved'];
    }

    /**
     * Get approved payments for the approver.
     *
     * @param Request $request
     * @return JsonResource
     */
    public function getApprovedPayments(Request $request): JsonResource
    {
        $payment = PaymentApproval::where('status', 'APPROVED')
            ->orWhere('user_id', $request->user_id)
            ->with(['user' => function ($query) {
                $query->where('type', 'APPROVER');
            }])->latest()->paginate();

        return PaymentApprovalResource::collection($payment);
    }
}
