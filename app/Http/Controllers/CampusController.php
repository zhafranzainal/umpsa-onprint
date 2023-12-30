<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Category;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-any', Campus::class);

        $campuses = Campus::All();
        return view('campuses.index', compact('campuses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus)
    {
        $this->authorize('view', $campus);

        $categories = Category::All();
        return view('campuses.show', compact('campus', 'categories'));
    }
}
