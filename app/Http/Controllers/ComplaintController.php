<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Complaint;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\ComplaintUpdateRequest;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Complaint::class);

        $search = $request->get('search', '');

        $complaints = Complaint::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('complaints.index', compact('complaints', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Complaint::class);

        $deliveries = Delivery::pluck('delivered_date', 'id');

        return view('complaints.create', compact('deliveries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Complaint::class);

        $validated = $request->validated();

        $complaint = Complaint::create($validated);

        return redirect()
            ->route('complaints.edit', $complaint)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Complaint $complaint): View
    {
        $this->authorize('view', $complaint);

        return view('complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Complaint $complaint): View
    {
        $this->authorize('update', $complaint);

        $deliveries = Delivery::pluck('delivered_date', 'id');

        return view('complaints.edit', compact('complaint', 'deliveries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ComplaintUpdateRequest $request,
        Complaint $complaint
    ): RedirectResponse {
        $this->authorize('update', $complaint);

        $validated = $request->validated();

        $complaint->update($validated);

        return redirect()
            ->route('complaints.edit', $complaint)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Complaint $complaint
    ): RedirectResponse {
        $this->authorize('delete', $complaint);

        $complaint->delete();

        return redirect()
            ->route('complaints.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
