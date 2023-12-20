<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;

use App\Models\Outlet;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\DeliveryOption;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
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
    public function it_gets_orders_list(): void
    {
        $orders = Order::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.orders.index'));

        $response->assertOk()->assertSee($orders[0]->document_file);
    }

    /**
     * @test
     */
    public function it_stores_the_order(): void
    {
        $data = Order::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.orders.store'), $data);

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_order(): void
    {
        $order = Order::factory()->create();

        $outlet = Outlet::factory()->create();
        $package = Package::factory()->create();
        $deliveryOption = DeliveryOption::factory()->create();
        $transaction = Transaction::factory()->create();

        $data = [
            'outlet_id' => $this->faker->randomNumber(),
            'package_id' => $this->faker->randomNumber(),
            'delivery_option_id' => $this->faker->randomNumber(),
            'transaction_id' => $this->faker->randomNumber(),
            'document_file' => $this->faker->text(255),
            'quantity' => $this->faker->randomNumber(),
            'total_price' => $this->faker->randomNumber(2),
            'point' => $this->faker->randomNumber(0),
            'status' => 'pending',
            'qr_code' => $this->faker->text(),
            'outlet_id' => $outlet->id,
            'package_id' => $package->id,
            'delivery_option_id' => $deliveryOption->id,
            'transaction_id' => $transaction->id,
        ];

        $response = $this->putJson(route('api.orders.update', $order), $data);

        $data['id'] = $order->id;

        $this->assertDatabaseHas('orders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->deleteJson(route('api.orders.destroy', $order));

        $this->assertSoftDeleted($order);

        $response->assertNoContent();
    }
}
