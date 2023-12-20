<?php

namespace App\Http\Controllers\Api;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OutletResource;
use App\Http\Resources\OutletCollection;
use App\Http\Requests\OutletStoreRequest;
use App\Http\Requests\OutletUpdateRequest;

class OutletController extends Controller
{
    public function index(Request $request): OutletCollection
    {
        $this->authorize('view-any', Outlet::class);

        $search = $request->get('search', '');

        $outlets = Outlet::search($search)
            ->latest()
            ->paginate();

        return new OutletCollection($outlets);
    }

    public function store(OutletStoreRequest $request): OutletResource
    {
        $this->authorize('create', Outlet::class);

        $validated = $request->validated();

        $outlet = Outlet::create($validated);

        return new OutletResource($outlet);
    }

    public function show(Request $request, Outlet $outlet): OutletResource
    {
        $this->authorize('view', $outlet);

        return new OutletResource($outlet);
    }

    public function update(
        OutletUpdateRequest $request,
        Outlet $outlet
    ): OutletResource {
        $this->authorize('update', $outlet);

        $validated = $request->validated();

        $outlet->update($validated);

        return new OutletResource($outlet);
    }

    public function destroy(Request $request, Outlet $outlet): Response
    {
        $this->authorize('delete', $outlet);

        $outlet->delete();

        return response()->noContent();
    }
}
