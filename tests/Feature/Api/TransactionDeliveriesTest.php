<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Delivery;
use App\Models\Transaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionDeliveriesTest extends TestCase
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
    public function it_gets_transaction_deliveries(): void
    {
        $transaction = Transaction::factory()->create();
        $deliveries = Delivery::factory()
            ->count(2)
            ->create([
                'transaction_id' => $transaction->id,
            ]);

        $response = $this->getJson(
            route('api.transactions.deliveries.index', $transaction)
        );

        $response->assertOk()->assertSee($deliveries[0]->delivered_date);
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_deliveries(): void
    {
        $transaction = Transaction::factory()->create();
        $data = Delivery::factory()
            ->make([
                'transaction_id' => $transaction->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.transactions.deliveries.store', $transaction),
            $data
        );

        $this->assertDatabaseHas('deliveries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $delivery = Delivery::latest('id')->first();

        $this->assertEquals($transaction->id, $delivery->transaction_id);
    }
}
