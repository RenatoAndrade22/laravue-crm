<?php

namespace App\Http\Controllers\Api;

use App\Laravue\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientCollection;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Client::query()->where('company_id', Auth::user()->company_id)->get();
    }

    /**
     * @param \App\Http\Requests\ClientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['company_id'] = Auth::user()->company_id;
        $client = new Client();
        $client->fill($request->all());
        $client->saveOrFail();
        return $client;
//        $this->authorize('create', Client::class); Auth::user()
//
//        $validated = $request->validated();


//        $client = Client::create($request->all());
//
//        return new ClientResource($client);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client)
    {
        $this->authorize('view', $client);

        return new ClientResource($client);
    }

    /**
     * @param \App\Http\Requests\ClientUpdateRequest $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $this->authorize('update', $client);

        $validated = $request->validated();

        $client->update($validated);

        return new ClientResource($client);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return response()->noContent();
    }
}
