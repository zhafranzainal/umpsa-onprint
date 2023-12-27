<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rider;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RiderStoreRequest;
use App\Http\Requests\RiderUpdateRequest;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Rider::class);

        $search = $request->get('search', '');

        $riders = Rider::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('riders.index', compact('riders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Rider::class);

        $users = User::pluck('name', 'id');

        return view('riders.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RiderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Rider::class);

        $validated = $request->validated();

        $rider = Rider::create($validated);

        return redirect()
            ->route('riders.edit', $rider)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Rider $rider): View
    {
        $this->authorize('view', $rider);

        return view('riders.show', compact('rider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Rider $rider): View
    {
        $this->authorize('update', $rider);

        $users = User::pluck('name', 'id');

        return view('riders.edit', compact('rider', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RiderUpdateRequest $request,
        Rider $rider
    ): RedirectResponse {
        $this->authorize('update', $rider);

        $validated = $request->validated();

        $rider->update($validated);

        return redirect()
            ->route('riders.edit', $rider)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Rider $rider): RedirectResponse
    {
        $this->authorize('delete', $rider);

        $rider->delete();

        return redirect()
            ->route('riders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
