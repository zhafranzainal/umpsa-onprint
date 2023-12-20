<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Http\Resources\PackageCollection;

class CategoryPackagesController extends Controller
{
    public function index(
        Request $request,
        Category $category
    ): PackageCollection {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $packages = $category
            ->packages()
            ->search($search)
            ->latest()
            ->paginate();

        return new PackageCollection($packages);
    }

    public function store(Request $request, Category $category): PackageResource
    {
        $this->authorize('create', Package::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'min_quantity' => ['required', 'numeric'],
            'price_rate' => ['required', 'numeric'],
        ]);

        $package = $category->packages()->create($validated);

        return new PackageResource($package);
    }
}
