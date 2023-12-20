<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionOrdersTest extends TestCase
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
    public function it_gets_transaction_orders(): void
    {
        $transaction = Transaction::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'transaction_id' => $transaction->id,
            ]);

        $response = $this->getJson(
            route('api.transactions.orders.index', $transaction)
        );

        $response->assertOk()->assertSee($orders[0]->document_file);
    }

    /**
     * @test
     */
    public function it_stores_the_transaction_orders(): void
    {
        $transaction = Transaction::factory()->create();
        $data = Order::factory()
            ->make([
                'transaction_id' => $transaction->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.transactions.orders.store', $transaction),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($transaction->id, $order->transaction_id);
    }
}
