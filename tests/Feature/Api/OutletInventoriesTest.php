<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Inventory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OutletInventoriesTest extends TestCase
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
    public function it_gets_outlet_inventories(): void
    {
        $outlet = Outlet::factory()->create();
        $inventory = Inventory::factory()->create();

        $outlet->inventories()->attach($inventory);

        $response = $this->getJson(
            route('api.outlets.inventories.index', $outlet)
        );

        $response->assertOk()->assertSee($inventory->name);
    }

    /**
     * @test
     */
    public function it_can_attach_inventories_to_outlet(): void
    {
        $outlet = Outlet::factory()->create();
        $inventory = Inventory::factory()->create();

        $response = $this->postJson(
            route('api.outlets.inventories.store', [$outlet, $inventory])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $outlet
                ->inventories()
                ->where('inventories.id', $inventory->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_inventories_from_outlet(): void
    {
        $outlet = Outlet::factory()->create();
        $inventory = Inventory::factory()->create();

        $response = $this->deleteJson(
            route('api.outlets.inventories.store', [$outlet, $inventory])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $outlet
                ->inventories()
                ->where('inventories.id', $inventory->id)
                ->exists()
        );
    }
}
