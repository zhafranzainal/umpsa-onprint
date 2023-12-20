<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Feedback;
use App\Models\Complaint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComplaintFeedbacksTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_complaint_feedbacks(): void
    {
        $complaint = Complaint::factory()->create();
        $feedbacks = Feedback::factory()
            ->count(2)
            ->create([
                'complaint_id' => $complaint->id,
            ]);

        $response = $this->getJson(
            route('api.complaints.feedbacks.index', $complaint)
        );

        $response->assertOk()->assertSee($feedbacks[0]->description);
    }

    /**
     * @test
     */
    public function it_stores_the_complaint_feedbacks(): void
    {
        $complaint = Complaint::factory()->create();
        $data = Feedback::factory()
            ->make([
                'complaint_id' => $complaint->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.complaints.feedbacks.store', $complaint),
            $data
        );

        $this->assertDatabaseHas('feedbacks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $feedback = Feedback::latest('id')->first();

        $this->assertEquals($complaint->id, $feedback->complaint_id);
    }
}
