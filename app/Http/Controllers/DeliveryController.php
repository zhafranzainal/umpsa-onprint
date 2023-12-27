<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DeliveryStoreRequest;
use App\Http\Requests\DeliveryUpdateRequest;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Delivery::class);

        $search = $request->get('search', '');

        $deliveries = Delivery::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('deliveries.index', compact('deliveries', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Delivery::class);

        $transactions = Transaction::pluck('id', 'id');

        return view('deliveries.create', compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Delivery::class);

        $validated = $request->validated();

        $delivery = Delivery::create($validated);

        return redirect()
            ->route('deliveries.edit', $delivery)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Delivery $delivery): View
    {
        $this->authorize('view', $delivery);

        return view('deliveries.show', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Delivery $delivery): View
    {
        $this->authorize('update', $delivery);

        $transactions = Transaction::pluck('id', 'id');

        return view('deliveries.edit', compact('delivery', 'transactions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DeliveryUpdateRequest $request,
        Delivery $delivery
    ): RedirectResponse {
        $this->authorize('update', $delivery);

        $validated = $request->validated();

        $delivery->update($validated);

        return redirect()
            ->route('deliveries.edit', $delivery)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Delivery $delivery
    ): RedirectResponse {
        $this->authorize('delete', $delivery);

        $delivery->delete();

        return redirect()
            ->route('deliveries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
