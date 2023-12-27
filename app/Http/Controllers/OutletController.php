<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Campus;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OutletStoreRequest;
use App\Http\Requests\OutletUpdateRequest;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Outlet::class);

        $search = $request->get('search', '');

        $outlets = Outlet::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('outlets.index', compact('outlets', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Outlet::class);

        $campuses = Campus::pluck('name', 'id');

        return view('outlets.create', compact('campuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OutletStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Outlet::class);

        $validated = $request->validated();

        $outlet = Outlet::create($validated);

        return redirect()
            ->route('outlets.edit', $outlet)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Outlet $outlet): View
    {
        $this->authorize('view', $outlet);

        return view('outlets.show', compact('outlet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Outlet $outlet): View
    {
        $this->authorize('update', $outlet);

        $campuses = Campus::pluck('name', 'id');

        return view('outlets.edit', compact('outlet', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OutletUpdateRequest $request,
        Outlet $outlet
    ): RedirectResponse {
        $this->authorize('update', $outlet);

        $validated = $request->validated();

        $outlet->update($validated);

        return redirect()
            ->route('outlets.edit', $outlet)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Outlet $outlet): RedirectResponse
    {
        $this->authorize('delete', $outlet);

        $outlet->delete();

        return redirect()
            ->route('outlets.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
