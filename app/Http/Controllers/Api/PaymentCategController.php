<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentCateg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentCategResource;
use App\Http\Resources\PaymentCategCollection;
use App\Http\Requests\PaymentCategStoreRequest;
use App\Http\Requests\PaymentCategUpdateRequest;

class PaymentCategController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PaymentCateg::class);

        $search = $request->get('search', '');

        $paymentCategs = PaymentCateg::search($search)
            ->latest()
            ->paginate();

        return new PaymentCategCollection($paymentCategs);
    }

    /**
     * @param \App\Http\Requests\PaymentCategStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentCategStoreRequest $request)
    {
        $this->authorize('create', PaymentCateg::class);

        $validated = $request->validated();

        $paymentCateg = PaymentCateg::create($validated);

        return new PaymentCategResource($paymentCateg);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentCateg $paymentCateg
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PaymentCateg $paymentCateg)
    {
        $this->authorize('view', $paymentCateg);

        return new PaymentCategResource($paymentCateg);
    }

    /**
     * @param \App\Http\Requests\PaymentCategUpdateRequest $request
     * @param \App\Models\PaymentCateg $paymentCateg
     * @return \Illuminate\Http\Response
     */
    public function update(
        PaymentCategUpdateRequest $request,
        PaymentCateg $paymentCateg
    ) {
        $this->authorize('update', $paymentCateg);

        $validated = $request->validated();

        $paymentCateg->update($validated);

        return new PaymentCategResource($paymentCateg);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentCateg $paymentCateg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PaymentCateg $paymentCateg)
    {
        $this->authorize('delete', $paymentCateg);

        $paymentCateg->delete();

        return response()->noContent();
    }
}
