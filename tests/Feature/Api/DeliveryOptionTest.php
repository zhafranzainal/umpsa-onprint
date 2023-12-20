<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DeliveryOption;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryOptionTest extends TestCase
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
    public function it_gets_delivery_options_list(): void
    {
        $deliveryOptions = DeliveryOption::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.delivery-options.index'));

        $response->assertOk()->assertSee($deliveryOptions[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_delivery_option(): void
    {
        $data = DeliveryOption::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.delivery-options.store'), $data);

        $this->assertDatabaseHas('delivery_options', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_delivery_option(): void
    {
        $deliveryOption = DeliveryOption::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(1),
        ];

        $response = $this->putJson(
            route('api.delivery-options.update', $deliveryOption),
            $data
        );

        $data['id'] = $deliveryOption->id;

        $this->assertDatabaseHas('delivery_options', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_delivery_option(): void
    {
        $deliveryOption = DeliveryOption::factory()->create();

        $response = $this->deleteJson(
            route('api.delivery-options.destroy', $deliveryOption)
        );

        $this->assertSoftDeleted($deliveryOption);

        $response->assertNoContent();
    }
}
