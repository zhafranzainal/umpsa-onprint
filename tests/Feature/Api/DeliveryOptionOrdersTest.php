<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\DeliveryOption;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryOptionOrdersTest extends TestCase
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
    public function it_gets_delivery_option_orders(): void
    {
        $deliveryOption = DeliveryOption::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'delivery_option_id' => $deliveryOption->id,
            ]);

        $response = $this->getJson(
            route('api.delivery-options.orders.index', $deliveryOption)
        );

        $response->assertOk()->assertSee($orders[0]->document_file);
    }

    /**
     * @test
     */
    public function it_stores_the_delivery_option_orders(): void
    {
        $deliveryOption = DeliveryOption::factory()->create();
        $data = Order::factory()
            ->make([
                'delivery_option_id' => $deliveryOption->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.delivery-options.orders.store', $deliveryOption),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($deliveryOption->id, $order->delivery_option_id);
    }
}
