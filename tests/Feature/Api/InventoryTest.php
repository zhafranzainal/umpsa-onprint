<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inventory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryTest extends TestCase
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
    public function it_gets_inventories_list(): void
    {
        $inventories = Inventory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.inventories.index'));

        $response->assertOk()->assertSee($inventories[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_inventory(): void
    {
        $data = Inventory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.inventories.store'), $data);

        $this->assertDatabaseHas('inventories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_inventory(): void
    {
        $inventory = Inventory::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.inventories.update', $inventory),
            $data
        );

        $data['id'] = $inventory->id;

        $this->assertDatabaseHas('inventories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_inventory(): void
    {
        $inventory = Inventory::factory()->create();

        $response = $this->deleteJson(
            route('api.inventories.destroy', $inventory)
        );

        $this->assertSoftDeleted($inventory);

        $response->assertNoContent();
    }
}
