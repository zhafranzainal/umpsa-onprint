<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Inventory::class);

        $search = $request->get('search', '');

        $inventories = Inventory::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('inventories.index', compact('inventories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Inventory::class);

        return view('inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Inventory::class);

        $validated = $request->validated();

        $inventory = Inventory::create($validated);

        return redirect()
            ->route('inventories.edit', $inventory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Inventory $inventory): View
    {
        $this->authorize('view', $inventory);

        return view('inventories.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Inventory $inventory): View
    {
        $this->authorize('update', $inventory);

        return view('inventories.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        InventoryUpdateRequest $request,
        Inventory $inventory
    ): RedirectResponse {
        $this->authorize('update', $inventory);

        $validated = $request->validated();

        $inventory->update($validated);

        return redirect()
            ->route('inventories.edit', $inventory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Inventory $inventory
    ): RedirectResponse {
        $this->authorize('delete', $inventory);

        $inventory->delete();

        return redirect()
            ->route('inventories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
