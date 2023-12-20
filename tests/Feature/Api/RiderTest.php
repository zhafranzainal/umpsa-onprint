<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rider;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RiderTest extends TestCase
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
    public function it_gets_riders_list(): void
    {
        $riders = Rider::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.riders.index'));

        $response->assertOk()->assertSee($riders[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_rider(): void
    {
        $data = Rider::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.riders.store'), $data);

        $this->assertDatabaseHas('riders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_rider(): void
    {
        $rider = Rider::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $this->faker->randomNumber(),
            'total_commission' => $this->faker->randomNumber(2),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.riders.update', $rider), $data);

        $data['id'] = $rider->id;

        $this->assertDatabaseHas('riders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_rider(): void
    {
        $rider = Rider::factory()->create();

        $response = $this->deleteJson(route('api.riders.destroy', $rider));

        $this->assertSoftDeleted($rider);

        $response->assertNoContent();
    }
}
