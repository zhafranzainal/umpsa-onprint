<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DeliveryOption;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryOptionResource;
use App\Http\Resources\DeliveryOptionCollection;
use App\Http\Requests\DeliveryOptionStoreRequest;
use App\Http\Requests\DeliveryOptionUpdateRequest;

class DeliveryOptionController extends Controller
{
    public function index(Request $request): DeliveryOptionCollection
    {
        $this->authorize('view-any', DeliveryOption::class);

        $search = $request->get('search', '');

        $deliveryOptions = DeliveryOption::search($search)
            ->latest()
            ->paginate();

        return new DeliveryOptionCollection($deliveryOptions);
    }

    public function store(
        DeliveryOptionStoreRequest $request
    ): DeliveryOptionResource {
        $this->authorize('create', DeliveryOption::class);

        $validated = $request->validated();

        $deliveryOption = DeliveryOption::create($validated);

        return new DeliveryOptionResource($deliveryOption);
    }

    public function show(
        Request $request,
        DeliveryOption $deliveryOption
    ): DeliveryOptionResource {
        $this->authorize('view', $deliveryOption);

        return new DeliveryOptionResource($deliveryOption);
    }

    public function update(
        DeliveryOptionUpdateRequest $request,
        DeliveryOption $deliveryOption
    ): DeliveryOptionResource {
        $this->authorize('update', $deliveryOption);

        $validated = $request->validated();

        $deliveryOption->update($validated);

        return new DeliveryOptionResource($deliveryOption);
    }

    public function destroy(
        Request $request,
        DeliveryOption $deliveryOption
    ): Response {
        $this->authorize('delete', $deliveryOption);

        $deliveryOption->delete();

        return response()->noContent();
    }
}
