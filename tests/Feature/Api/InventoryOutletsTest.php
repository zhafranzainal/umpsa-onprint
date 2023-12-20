<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Inventory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryOutletsTest extends TestCase
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
    public function it_gets_inventory_outlets(): void
    {
        $inventory = Inventory::factory()->create();
        $outlet = Outlet::factory()->create();

        $inventory->outlets()->attach($outlet);

        $response = $this->getJson(
            route('api.inventories.outlets.index', $inventory)
        );

        $response->assertOk()->assertSee($outlet->name);
    }

    /**
     * @test
     */
    public function it_can_attach_outlets_to_inventory(): void
    {
        $inventory = Inventory::factory()->create();
        $outlet = Outlet::factory()->create();

        $response = $this->postJson(
            route('api.inventories.outlets.store', [$inventory, $outlet])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $inventory
                ->outlets()
                ->where('outlets.id', $outlet->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_outlets_from_inventory(): void
    {
        $inventory = Inventory::factory()->create();
        $outlet = Outlet::factory()->create();

        $response = $this->deleteJson(
            route('api.inventories.outlets.store', [$inventory, $outlet])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $inventory
                ->outlets()
                ->where('outlets.id', $outlet->id)
                ->exists()
        );
    }
}
