<?php

namespace App\Http\Controllers\Api;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\FeedbackCollection;

class ComplaintFeedbacksController extends Controller
{
    public function index(
        Request $request,
        Complaint $complaint
    ): FeedbackCollection {
        $this->authorize('view', $complaint);

        $search = $request->get('search', '');

        $feedbacks = $complaint
            ->feedbacks()
            ->search($search)
            ->latest()
            ->paginate();

        return new FeedbackCollection($feedbacks);
    }

    public function store(
        Request $request,
        Complaint $complaint
    ): FeedbackResource {
        $this->authorize('create', Feedback::class);

        $validated = $request->validate([
            'description' => ['required', 'max:255', 'string'],
        ]);

        $feedback = $complaint->feedbacks()->create($validated);

        return new FeedbackResource($feedback);
    }
}
