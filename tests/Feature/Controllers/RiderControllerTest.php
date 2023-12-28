<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Rider;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RiderControllerTest extends TestCase
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
    public function it_displays_index_view_with_riders(): void
    {
        $riders = Rider::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('riders.index'));

        $response
            ->assertOk()
            ->assertViewIs('riders.index')
            ->assertViewHas('riders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_rider(): void
    {
        $response = $this->get(route('riders.create'));

        $response->assertOk()->assertViewIs('riders.create');
    }

    /**
     * @test
     */
    public function it_stores_the_rider(): void
    {
        $data = Rider::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('riders.store'), $data);

        $this->assertDatabaseHas('riders', $data);

        $rider = Rider::latest('id')->first();

        $response->assertRedirect(route('riders.edit', $rider));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_rider(): void
    {
        $rider = Rider::factory()->create();

        $response = $this->get(route('riders.show', $rider));

        $response
            ->assertOk()
            ->assertViewIs('riders.show')
            ->assertViewHas('rider');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_rider(): void
    {
        $rider = Rider::factory()->create();

        $response = $this->get(route('riders.edit', $rider));

        $response
            ->assertOk()
            ->assertViewIs('riders.edit')
            ->assertViewHas('rider');
    }

    /**
     * @test
     */
    public function it_updates_the_rider(): void
    {
        $rider = Rider::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $this->faker->randomNumber(),
            'total_commission' => $this->faker->randomNumber(2),
            'user_id' => $user->id,
        ];

        $response = $this->put(route('riders.update', $rider), $data);

        $data['id'] = $rider->id;

        $this->assertDatabaseHas('riders', $data);

        $response->assertRedirect(route('riders.edit', $rider));
    }

    /**
     * @test
     */
    public function it_deletes_the_rider(): void
    {
        $rider = Rider::factory()->create();

        $response = $this->delete(route('riders.destroy', $rider));

        $response->assertRedirect(route('riders.index'));

        $this->assertSoftDeleted($rider);
    }
}
