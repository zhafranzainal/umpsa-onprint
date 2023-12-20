<?php
namespace App\Http\Controllers\Api;

use App\Models\Outlet;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OutletCollection;

class InventoryOutletsController extends Controller
{
    public function index(
        Request $request,
        Inventory $inventory
    ): OutletCollection {
        $this->authorize('view', $inventory);

        $search = $request->get('search', '');

        $outlets = $inventory
            ->outlets()
            ->search($search)
            ->latest()
            ->paginate();

        return new OutletCollection($outlets);
    }

    public function store(
        Request $request,
        Inventory $inventory,
        Outlet $outlet
    ): Response {
        $this->authorize('update', $inventory);

        $inventory->outlets()->syncWithoutDetaching([$outlet->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Inventory $inventory,
        Outlet $outlet
    ): Response {
        $this->authorize('update', $inventory);

        $inventory->outlets()->detach($outlet);

        return response()->noContent();
    }
}
