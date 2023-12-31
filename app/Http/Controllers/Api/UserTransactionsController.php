<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;

class UserTransactionsController extends Controller
{
    public function index(Request $request, User $user): TransactionCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $transactions = $user
            ->transactions()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransactionCollection($transactions);
    }

    public function store(Request $request, User $user): TransactionResource
    {
        $this->authorize('create', Transaction::class);

        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'status' => ['required', 'in:pending,successful,failed'],
        ]);

        $transaction = $user->transactions()->create($validated);

        return new TransactionResource($transaction);
    }
}
