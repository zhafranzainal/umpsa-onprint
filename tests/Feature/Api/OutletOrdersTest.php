<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Outlet;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OutletOrdersTest extends TestCase
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
    public function it_gets_outlet_orders(): void
    {
        $outlet = Outlet::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'outlet_id' => $outlet->id,
            ]);

        $response = $this->getJson(route('api.outlets.orders.index', $outlet));

        $response->assertOk()->assertSee($orders[0]->document_file);
    }

    /**
     * @test
     */
    public function it_stores_the_outlet_orders(): void
    {
        $outlet = Outlet::factory()->create();
        $data = Order::factory()
            ->make([
                'outlet_id' => $outlet->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.outlets.orders.store', $outlet),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($outlet->id, $order->outlet_id);
    }
}
