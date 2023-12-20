<?php

namespace App\Http\Controllers\Api;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\DeliveryCollection;
use App\Http\Requests\DeliveryStoreRequest;
use App\Http\Requests\DeliveryUpdateRequest;

class DeliveryController extends Controller
{
    public function index(Request $request): DeliveryCollection
    {
        $this->authorize('view-any', Delivery::class);

        $search = $request->get('search', '');

        $deliveries = Delivery::search($search)
            ->latest()
            ->paginate();

        return new DeliveryCollection($deliveries);
    }

    public function store(DeliveryStoreRequest $request): DeliveryResource
    {
        $this->authorize('create', Delivery::class);

        $validated = $request->validated();

        $delivery = Delivery::create($validated);

        return new DeliveryResource($delivery);
    }

    public function show(Request $request, Delivery $delivery): DeliveryResource
    {
        $this->authorize('view', $delivery);

        return new DeliveryResource($delivery);
    }

    public function update(
        DeliveryUpdateRequest $request,
        Delivery $delivery
    ): DeliveryResource {
        $this->authorize('update', $delivery);

        $validated = $request->validated();

        $delivery->update($validated);

        return new DeliveryResource($delivery);
    }

    public function destroy(Request $request, Delivery $delivery): Response
    {
        $this->authorize('delete', $delivery);

        $delivery->delete();

        return response()->noContent();
    }
}
