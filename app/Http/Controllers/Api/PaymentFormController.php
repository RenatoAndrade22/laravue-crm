<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentFormResource;
use App\Http\Resources\PaymentFormCollection;
use App\Http\Requests\PaymentFormStoreRequest;
use App\Http\Requests\PaymentFormUpdateRequest;

class PaymentFormController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PaymentForm::class);

        $search = $request->get('search', '');

        $paymentForms = PaymentForm::search($search)
            ->latest()
            ->paginate();

        return new PaymentFormCollection($paymentForms);
    }

    /**
     * @param \App\Http\Requests\PaymentFormStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentFormStoreRequest $request)
    {
        $this->authorize('create', PaymentForm::class);

        $validated = $request->validated();

        $paymentForm = PaymentForm::create($validated);

        return new PaymentFormResource($paymentForm);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentForm $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PaymentForm $paymentForm)
    {
        $this->authorize('view', $paymentForm);

        return new PaymentFormResource($paymentForm);
    }

    /**
     * @param \App\Http\Requests\PaymentFormUpdateRequest $request
     * @param \App\Models\PaymentForm $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function update(
        PaymentFormUpdateRequest $request,
        PaymentForm $paymentForm
    ) {
        $this->authorize('update', $paymentForm);

        $validated = $request->validated();

        $paymentForm->update($validated);

        return new PaymentFormResource($paymentForm);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PaymentForm $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PaymentForm $paymentForm)
    {
        $this->authorize('delete', $paymentForm);

        $paymentForm->delete();

        return response()->noContent();
    }
}
