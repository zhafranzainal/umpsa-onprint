<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Order;

use App\Models\Outlet;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\DeliveryOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_orders(): void
    {
        $orders = Order::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('orders.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.orders.index')
            ->assertViewHas('orders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_order(): void
    {
        $response = $this->get(route('orders.create'));

        $response->assertOk()->assertViewIs('app.orders.create');
    }

    /**
     * @test
     */
    public function it_stores_the_order(): void
    {
        $data = Order::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('orders.store'), $data);

        $this->assertDatabaseHas('orders', $data);

        $order = Order::latest('id')->first();

        $response->assertRedirect(route('orders.edit', $order));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response
            ->assertOk()
            ->assertViewIs('app.orders.show')
            ->assertViewHas('order');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.edit', $order));

        $response
            ->assertOk()
            ->assertViewIs('app.orders.edit')
            ->assertViewHas('order');
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

        $response = $this->put(route('orders.update', $order), $data);

        $data['id'] = $order->id;

        $this->assertDatabaseHas('orders', $data);

        $response->assertRedirect(route('orders.edit', $order));
    }

    /**
     * @test
     */
    public function it_deletes_the_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertRedirect(route('orders.index'));

        $this->assertSoftDeleted($order);
    }
}
