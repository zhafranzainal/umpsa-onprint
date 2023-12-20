<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DeliveryOption;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DeliveryOptionStoreRequest;
use App\Http\Requests\DeliveryOptionUpdateRequest;

class DeliveryOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DeliveryOption::class);

        $search = $request->get('search', '');

        $deliveryOptions = DeliveryOption::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.delivery_options.index',
            compact('deliveryOptions', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DeliveryOption::class);

        return view('app.delivery_options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryOptionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', DeliveryOption::class);

        $validated = $request->validated();

        $deliveryOption = DeliveryOption::create($validated);

        return redirect()
            ->route('delivery-options.edit', $deliveryOption)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, DeliveryOption $deliveryOption): View
    {
        $this->authorize('view', $deliveryOption);

        return view('app.delivery_options.show', compact('deliveryOption'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, DeliveryOption $deliveryOption): View
    {
        $this->authorize('update', $deliveryOption);

        return view('app.delivery_options.edit', compact('deliveryOption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DeliveryOptionUpdateRequest $request,
        DeliveryOption $deliveryOption
    ): RedirectResponse {
        $this->authorize('update', $deliveryOption);

        $validated = $request->validated();

        $deliveryOption->update($validated);

        return redirect()
            ->route('delivery-options.edit', $deliveryOption)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DeliveryOption $deliveryOption
    ): RedirectResponse {
        $this->authorize('delete', $deliveryOption);

        $deliveryOption->delete();

        return redirect()
            ->route('delivery-options.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
