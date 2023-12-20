<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Delivery;

use App\Models\Transaction;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryControllerTest extends TestCase
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
    public function it_displays_index_view_with_deliveries(): void
    {
        $deliveries = Delivery::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('deliveries.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.deliveries.index')
            ->assertViewHas('deliveries');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_delivery(): void
    {
        $response = $this->get(route('deliveries.create'));

        $response->assertOk()->assertViewIs('app.deliveries.create');
    }

    /**
     * @test
     */
    public function it_stores_the_delivery(): void
    {
        $data = Delivery::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('deliveries.store'), $data);

        $this->assertDatabaseHas('deliveries', $data);

        $delivery = Delivery::latest('id')->first();

        $response->assertRedirect(route('deliveries.edit', $delivery));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_delivery(): void
    {
        $delivery = Delivery::factory()->create();

        $response = $this->get(route('deliveries.show', $delivery));

        $response
            ->assertOk()
            ->assertViewIs('app.deliveries.show')
            ->assertViewHas('delivery');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_delivery(): void
    {
        $delivery = Delivery::factory()->create();

        $response = $this->get(route('deliveries.edit', $delivery));

        $response
            ->assertOk()
            ->assertViewIs('app.deliveries.edit')
            ->assertViewHas('delivery');
    }

    /**
     * @test
     */
    public function it_updates_the_delivery(): void
    {
        $delivery = Delivery::factory()->create();

        $transaction = Transaction::factory()->create();

        $data = [
            'transaction_id' => $this->faker->randomNumber(),
            'commission_fee' => $this->faker->randomNumber(2),
            'delivered_date' => $this->faker->dateTime(),
            'transaction_id' => $transaction->id,
        ];

        $response = $this->put(route('deliveries.update', $delivery), $data);

        $data['id'] = $delivery->id;

        $this->assertDatabaseHas('deliveries', $data);

        $response->assertRedirect(route('deliveries.edit', $delivery));
    }

    /**
     * @test
     */
    public function it_deletes_the_delivery(): void
    {
        $delivery = Delivery::factory()->create();

        $response = $this->delete(route('deliveries.destroy', $delivery));

        $response->assertRedirect(route('deliveries.index'));

        $this->assertSoftDeleted($delivery);
    }
}
