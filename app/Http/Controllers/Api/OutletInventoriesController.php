<?php
namespace App\Http\Controllers\Api;

use App\Models\Outlet;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryCollection;

class OutletInventoriesController extends Controller
{
    public function index(Request $request, Outlet $outlet): InventoryCollection
    {
        $this->authorize('view', $outlet);

        $search = $request->get('search', '');

        $inventories = $outlet
            ->inventories()
            ->search($search)
            ->latest()
            ->paginate();

        return new InventoryCollection($inventories);
    }

    public function store(
        Request $request,
        Outlet $outlet,
        Inventory $inventory
    ): Response {
        $this->authorize('update', $outlet);

        $outlet->inventories()->syncWithoutDetaching([$inventory->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Outlet $outlet,
        Inventory $inventory
    ): Response {
        $this->authorize('update', $outlet);

        $outlet->inventories()->detach($inventory);

        return response()->noContent();
    }
}
