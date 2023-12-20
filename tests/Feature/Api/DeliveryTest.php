<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Delivery;

use App\Models\Transaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryTest extends TestCase
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
    public function it_gets_deliveries_list(): void
    {
        $deliveries = Delivery::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.deliveries.index'));

        $response->assertOk()->assertSee($deliveries[0]->delivered_date);
    }

    /**
     * @test
     */
    public function it_stores_the_delivery(): void
    {
        $data = Delivery::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.deliveries.store'), $data);

        $this->assertDatabaseHas('deliveries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.deliveries.update', $delivery),
            $data
        );

        $data['id'] = $delivery->id;

        $this->assertDatabaseHas('deliveries', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_delivery(): void
    {
        $delivery = Delivery::factory()->create();

        $response = $this->deleteJson(
            route('api.deliveries.destroy', $delivery)
        );

        $this->assertSoftDeleted($delivery);

        $response->assertNoContent();
    }
}
