<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\DeliveryCollection;

class TransactionDeliveriesController extends Controller
{
    public function index(
        Request $request,
        Transaction $transaction
    ): DeliveryCollection {
        $this->authorize('view', $transaction);

        $search = $request->get('search', '');

        $deliveries = $transaction
            ->deliveries()
            ->search($search)
            ->latest()
            ->paginate();

        return new DeliveryCollection($deliveries);
    }

    public function store(
        Request $request,
        Transaction $transaction
    ): DeliveryResource {
        $this->authorize('create', Delivery::class);

        $validated = $request->validate([
            'commission_fee' => ['required', 'numeric'],
            'delivered_date' => ['required', 'date'],
        ]);

        $delivery = $transaction->deliveries()->create($validated);

        return new DeliveryResource($delivery);
    }
}
