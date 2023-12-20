<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DeliveryOption;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryOptionControllerTest extends TestCase
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
    public function it_displays_index_view_with_delivery_options(): void
    {
        $deliveryOptions = DeliveryOption::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('delivery-options.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.delivery_options.index')
            ->assertViewHas('deliveryOptions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_delivery_option(): void
    {
        $response = $this->get(route('delivery-options.create'));

        $response->assertOk()->assertViewIs('app.delivery_options.create');
    }

    /**
     * @test
     */
    public function it_stores_the_delivery_option(): void
    {
        $data = DeliveryOption::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('delivery-options.store'), $data);

        $this->assertDatabaseHas('delivery_options', $data);

        $deliveryOption = DeliveryOption::latest('id')->first();

        $response->assertRedirect(
            route('delivery-options.edit', $deliveryOption)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_delivery_option(): void
    {
        $deliveryOption = DeliveryOption::factory()->create();

        $response = $this->get(route('delivery-options.show', $deliveryOption));

        $response
            ->assertOk()
            ->assertViewIs('app.delivery_options.show')
            ->assertViewHas('deliveryOption');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_delivery_option(): void
    {
        $deliveryOption = DeliveryOption::factory()->create();

        $response = $this->get(route('delivery-options.edit', $deliveryOption));

        $response
            ->assertOk()
            ->assertViewIs('app.delivery_options.edit')
            ->assertViewHas('deliveryOption');
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

        $response = $this->put(
            route('delivery-options.update', $deliveryOption),
            $data
        );

        $data['id'] = $deliveryOption->id;

        $this->assertDatabaseHas('delivery_options', $data);

        $response->assertRedirect(
            route('delivery-options.edit', $deliveryOption)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_delivery_option(): void
    {
        $deliveryOption = DeliveryOption::factory()->create();

        $response = $this->delete(
            route('delivery-options.destroy', $deliveryOption)
        );

        $response->assertRedirect(route('delivery-options.index'));

        $this->assertSoftDeleted($deliveryOption);
    }
}
