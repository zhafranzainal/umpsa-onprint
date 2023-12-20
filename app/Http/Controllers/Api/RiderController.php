<?php

namespace App\Http\Controllers\Api;

use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RiderResource;
use App\Http\Resources\RiderCollection;
use App\Http\Requests\RiderStoreRequest;
use App\Http\Requests\RiderUpdateRequest;

class RiderController extends Controller
{
    public function index(Request $request): RiderCollection
    {
        $this->authorize('view-any', Rider::class);

        $search = $request->get('search', '');

        $riders = Rider::search($search)
            ->latest()
            ->paginate();

        return new RiderCollection($riders);
    }

    public function store(RiderStoreRequest $request): RiderResource
    {
        $this->authorize('create', Rider::class);

        $validated = $request->validated();

        $rider = Rider::create($validated);

        return new RiderResource($rider);
    }

    public function show(Request $request, Rider $rider): RiderResource
    {
        $this->authorize('view', $rider);

        return new RiderResource($rider);
    }

    public function update(
        RiderUpdateRequest $request,
        Rider $rider
    ): RiderResource {
        $this->authorize('update', $rider);

        $validated = $request->validated();

        $rider->update($validated);

        return new RiderResource($rider);
    }

    public function destroy(Request $request, Rider $rider): Response
    {
        $this->authorize('delete', $rider);

        $rider->delete();

        return response()->noContent();
    }
}
