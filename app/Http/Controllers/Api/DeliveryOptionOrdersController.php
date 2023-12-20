<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DeliveryOption;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class DeliveryOptionOrdersController extends Controller
{
    public function index(
        Request $request,
        DeliveryOption $deliveryOption
    ): OrderCollection {
        $this->authorize('view', $deliveryOption);

        $search = $request->get('search', '');

        $orders = $deliveryOption
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(
        Request $request,
        DeliveryOption $deliveryOption
    ): OrderResource {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'outlet_id' => ['required', 'exists:outlets,id'],
            'package_id' => ['required', 'exists:packages,id'],
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

        $order = $deliveryOption->orders()->create($validated);

        return new OrderResource($order);
    }
}
