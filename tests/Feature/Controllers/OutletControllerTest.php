<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Outlet;

use App\Models\Campus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OutletControllerTest extends TestCase
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
    public function it_displays_index_view_with_outlets(): void
    {
        $outlets = Outlet::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('outlets.index'));

        $response
            ->assertOk()
            ->assertViewIs('outlets.index')
            ->assertViewHas('outlets');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_outlet(): void
    {
        $response = $this->get(route('outlets.create'));

        $response->assertOk()->assertViewIs('outlets.create');
    }

    /**
     * @test
     */
    public function it_stores_the_outlet(): void
    {
        $data = Outlet::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('outlets.store'), $data);

        $this->assertDatabaseHas('outlets', $data);

        $outlet = Outlet::latest('id')->first();

        $response->assertRedirect(route('outlets.edit', $outlet));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_outlet(): void
    {
        $outlet = Outlet::factory()->create();

        $response = $this->get(route('outlets.show', $outlet));

        $response
            ->assertOk()
            ->assertViewIs('outlets.show')
            ->assertViewHas('outlet');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_outlet(): void
    {
        $outlet = Outlet::factory()->create();

        $response = $this->get(route('outlets.edit', $outlet));

        $response
            ->assertOk()
            ->assertViewIs('outlets.edit')
            ->assertViewHas('outlet');
    }

    /**
     * @test
     */
    public function it_updates_the_outlet(): void
    {
        $outlet = Outlet::factory()->create();

        $campus = Campus::factory()->create();

        $data = [
            'campus_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'campus_id' => $campus->id,
        ];

        $response = $this->put(route('outlets.update', $outlet), $data);

        $data['id'] = $outlet->id;

        $this->assertDatabaseHas('outlets', $data);

        $response->assertRedirect(route('outlets.edit', $outlet));
    }

    /**
     * @test
     */
    public function it_deletes_the_outlet(): void
    {
        $outlet = Outlet::factory()->create();

        $response = $this->delete(route('outlets.destroy', $outlet));

        $response->assertRedirect(route('outlets.index'));

        $this->assertSoftDeleted($outlet);
    }
}
