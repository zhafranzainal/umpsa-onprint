<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Category;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campus $campus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {
        //
    }
}