<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Outlet;
use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DeliveryOption;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Order::class);

        $orders = Order::All();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Order::class);

        $outlets = Outlet::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $deliveryOptions = DeliveryOption::pluck('name', 'id');
        $transactions = Transaction::pluck('id', 'id');

        return view(
            'orders.create',
            compact('outlets', 'categories', 'deliveryOptions', 'transactions')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Order::class);

        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $fileName = $file->getClientOriginalName();

            // Store the file in the specified directory
            $file->storeAs('public/documents', $fileName);

            // Save only the file name to the database
            $validated['document_file'] = $fileName;
        }

        $category = Category::findOrFail($validated['category_id']);
        $totalPrice = $category->price * $validated['quantity'];
        $validated['total_price'] = $totalPrice;

        $order = Order::create($validated);

        return redirect()->route('orders.edit', $order)->withSuccess(__('crud.common.created'));
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
        $categories = Category::pluck('name', 'id');
        $deliveryOptions = DeliveryOption::pluck('name', 'id');
        $transactions = Transaction::pluck('id', 'id');

        return view(
            'orders.edit',
            compact(
                'order',
                'outlets',
                'categories',
                'deliveryOptions',
                'transactions'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        $this->authorize('update', $order);

        $validated = $request->validated();

        if ($request->hasFile('document_file')) {

            if ($order->document_file) {
                Storage::delete($order->document_file);
            }

            $file = $request->file('document_file');
            $fileName = $file->getClientOriginalName();

            // Store the file in the specified directory
            $file->storeAs('public/documents', $fileName);

            // Save only the file name to the database
            $validated['document_file'] = $fileName;
        }

        $category = Category::findOrFail($validated['category_id']);
        $totalPrice = $category->price * $validated['quantity'];
        $validated['total_price'] = $totalPrice;

        $order->update($validated);

        return redirect()->route('orders.edit', $order)->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Order $order): RedirectResponse
    {
        $this->authorize('delete', $order);

        $order->delete();

        return redirect()->route('orders.index')->withSuccess(__('crud.common.removed'));
    }
}
