<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class TransactionOrdersController extends Controller
{
    public function index(
        Request $request,
        Transaction $transaction
    ): OrderCollection {
        $this->authorize('view', $transaction);

        $search = $request->get('search', '');

        $orders = $transaction
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(
        Request $request,
        Transaction $transaction
    ): OrderResource {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'outlet_id' => ['required', 'exists:outlets,id'],
            'package_id' => ['required', 'exists:packages,id'],
            'delivery_option_id' => ['required', 'exists:delivery_options,id'],
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

        $order = $transaction->orders()->create($validated);

        return new OrderResource($order);
    }
}
