<?php

namespace App\Http\Controllers\Api;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ProviderCollection;
use App\Http\Requests\ProviderStoreRequest;
use App\Http\Requests\ProviderUpdateRequest;

class ProviderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Provider::class);

        $search = $request->get('search', '');

        $providers = Provider::search($search)
            ->latest()
            ->paginate();

        return new ProviderCollection($providers);
    }

    /**
     * @param \App\Http\Requests\ProviderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderStoreRequest $request)
    {
        $this->authorize('create', Provider::class);

        $validated = $request->validated();

        $provider = Provider::create($validated);

        return new ProviderResource($provider);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Provider $provider)
    {
        $this->authorize('view', $provider);

        return new ProviderResource($provider);
    }

    /**
     * @param \App\Http\Requests\ProviderUpdateRequest $request
     * @param \App\Models\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderUpdateRequest $request, Provider $provider)
    {
        $this->authorize('update', $provider);

        $validated = $request->validated();

        $provider->update($validated);

        return new ProviderResource($provider);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Provider $provider)
    {
        $this->authorize('delete', $provider);

        $provider->delete();

        return response()->noContent();
    }
}
