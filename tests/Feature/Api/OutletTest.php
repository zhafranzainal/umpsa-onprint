<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Outlet;

use App\Models\Campus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OutletTest extends TestCase
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
    public function it_gets_outlets_list(): void
    {
        $outlets = Outlet::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.outlets.index'));

        $response->assertOk()->assertSee($outlets[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_outlet(): void
    {
        $data = Outlet::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.outlets.store'), $data);

        $this->assertDatabaseHas('outlets', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_outlet(): void
    {
        $outlet = Outlet::factory()->create();

        $campus = Campus::factory()->create();

        $data = [
            'campus_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'campus_id' => $campus->id,
        ];

        $response = $this->putJson(route('api.outlets.update', $outlet), $data);

        $data['id'] = $outlet->id;

        $this->assertDatabaseHas('outlets', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_outlet(): void
    {
        $outlet = Outlet::factory()->create();

        $response = $this->deleteJson(route('api.outlets.destroy', $outlet));

        $this->assertSoftDeleted($outlet);

        $response->assertNoContent();
    }
}
