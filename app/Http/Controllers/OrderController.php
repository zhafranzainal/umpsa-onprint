<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Outlet;
use App\Models\Package;
use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DeliveryOption;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Campus;

class OrderController extends Controller
{

    /**
     * Display a listing of the campus.
     */
    public function indexCampus(Request $request): View
    {
        $this->authorize('view-any', Campus::class);

        $campuses = Campus::All();
        return view('orders.index-campus', compact('campuses'));
    }

    /**
     * Display the specified campus.
     */
    public function showCampus(Request $request, Campus $campus): View
    {
        $this->authorize('view', $campus);

        return view('orders.show-campus', compact('campus'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Campus::class);

        $campuses = Campus::All();
        return view('orders.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Order::class);

        $outlets = Outlet::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');
        $deliveryOptions = DeliveryOption::pluck('name', 'id');
        $transactions = Transaction::pluck('id', 'id');

        return view(
            'app.orders.create',
            compact('outlets', 'packages', 'deliveryOptions', 'transactions')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Order::class);

        $validated = $request->validated();

        $order = Order::create($validated);

        return redirect()
            ->route('orders.edit', $order)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Order $order): View
    {
        $this->authorize('view', $order);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Order $order): View
    {
        $this->authorize('update', $order);

        $outlets = Outlet::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');
        $deliveryOptions = DeliveryOption::pluck('name', 'id');
        $transactions = Transaction::pluck('id', 'id');

        return view(
            'app.orders.edit',
            compact(
                'order',
                'outlets',
                'packages',
                'deliveryOptions',
                'transactions'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OrderUpdateRequest $request,
        Order $order
    ): RedirectResponse {
        $this->authorize('update', $order);

        $validated = $request->validated();

        $order->update($validated);

        return redirect()
            ->route('orders.edit', $order)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Order $order): RedirectResponse
    {
        $this->authorize('delete', $order);

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
