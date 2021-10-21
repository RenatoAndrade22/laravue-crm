<?php

namespace App\Http\Controllers\Api;

use App\Models\payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\paymentResource;
use App\Http\Resources\paymentCollection;
use App\Http\Requests\paymentStoreRequest;
use App\Http\Requests\paymentUpdateRequest;

class paymentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', payment::class);

        $search = $request->get('search', '');

        $payments = payment::search($search)
            ->latest()
            ->paginate();

        return new paymentCollection($payments);
    }

    /**
     * @param \App\Http\Requests\paymentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(paymentStoreRequest $request)
    {
        $this->authorize('create', payment::class);

        $validated = $request->validated();

        $payment = payment::create($validated);

        return new paymentResource($payment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, payment $payment)
    {
        $this->authorize('view', $payment);

        return new paymentResource($payment);
    }

    /**
     * @param \App\Http\Requests\paymentUpdateRequest $request
     * @param \App\Models\payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(paymentUpdateRequest $request, payment $payment)
    {
        $this->authorize('update', $payment);

        $validated = $request->validated();

        $payment->update($validated);

        return new paymentResource($payment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, payment $payment)
    {
        $this->authorize('delete', $payment);

        $payment->delete();

        return response()->noContent();
    }
}
