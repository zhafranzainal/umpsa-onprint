<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyOrderCampus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve order ID from the request
        $orderId = $request->route('order')->id;

        // Get order details
        $order = Order::findOrFail($orderId);

        // Check if the order belongs to the current user's campus
        if (!$this->orderBelongsToUserCampus($order)) {
            return redirect()->route('campuses.index')->with('error', 'Unauthorized: This order does not belong to your campus.');
        }

        return $next($request);
    }

    private function orderBelongsToUserCampus(Order $order)
    {
        $userCampusId = auth()->user()->campus_id;

        return $order->outlet->campus_id === $userCampusId;
    }
}
