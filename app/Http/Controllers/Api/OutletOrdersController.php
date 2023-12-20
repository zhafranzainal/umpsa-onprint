<?php

namespace App\Http\Controllers\Api;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class OutletOrdersController extends Controller
{
    public function index(Request $request, Outlet $outlet): OrderCollection
    {
        $this->authorize('view', $outlet);

        $search = $request->get('search', '');

        $orders = $outlet
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(Request $request, Outlet $outlet): OrderResource
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'delivery_option_id' => ['required', 'exists:delivery_options,id'],
            'transaction_id' => ['required', 'exists:transactions,id'],
            'document_file' => ['required', 'max:255', 'string'],
            'quantity' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'point' => ['required', 'numeric'],
            'status' => [
                'required',
                'in:pending,ordered,prepared,picked up,completed',
            ],
            'qr_code' => ['required', 'max:255', 'string'],
        ]);

        $order = $outlet->orders()->create($validated);

        return new OrderResource($order);
    }
}
