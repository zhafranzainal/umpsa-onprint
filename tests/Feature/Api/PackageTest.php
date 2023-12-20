<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Package;

use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageTest extends TestCase
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
    public function it_gets_packages_list(): void
    {
        $packages = Package::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.packages.index'));

        $response->assertOk()->assertSee($packages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_package(): void
    {
        $data = Package::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.packages.store'), $data);

        $this->assertDatabaseHas('packages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_package(): void
    {
        $package = Package::factory()->create();

        $category = Category::factory()->create();

        $data = [
            'category_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'min_quantity' => $this->faker->randomNumber(0),
            'price_rate' => $this->faker->randomNumber(2),
            'category_id' => $category->id,
        ];

        $response = $this->putJson(
            route('api.packages.update', $package),
            $data
        );

        $data['id'] = $package->id;

        $this->assertDatabaseHas('packages', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_package(): void
    {
        $package = Package::factory()->create();

        $response = $this->deleteJson(route('api.packages.destroy', $package));

        $this->assertSoftDeleted($package);

        $response->assertNoContent();
    }
}
