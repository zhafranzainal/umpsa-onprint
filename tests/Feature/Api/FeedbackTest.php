<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Feedback;

use App\Models\Complaint;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
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
    public function it_gets_feedbacks_list(): void
    {
        $feedbacks = Feedback::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.feedbacks.index'));

        $response->assertOk()->assertSee($feedbacks[0]->description);
    }

    /**
     * @test
     */
    public function it_stores_the_feedback(): void
    {
        $data = Feedback::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.feedbacks.store'), $data);

        $this->assertDatabaseHas('feedbacks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_feedback(): void
    {
        $feedback = Feedback::factory()->create();

        $complaint = Complaint::factory()->create();

        $data = [
            'complaint_id' => $this->faker->randomNumber(),
            'description' => $this->faker->sentence(15),
            'complaint_id' => $complaint->id,
        ];

        $response = $this->putJson(
            route('api.feedbacks.update', $feedback),
            $data
        );

        $data['id'] = $feedback->id;

        $this->assertDatabaseHas('feedbacks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_feedback(): void
    {
        $feedback = Feedback::factory()->create();

        $response = $this->deleteJson(
            route('api.feedbacks.destroy', $feedback)
        );

        $this->assertSoftDeleted($feedback);

        $response->assertNoContent();
    }
}
