<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Package;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryPackagesTest extends TestCase
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
    public function it_gets_category_packages(): void
    {
        $category = Category::factory()->create();
        $packages = Package::factory()
            ->count(2)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.packages.index', $category)
        );

        $response->assertOk()->assertSee($packages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_category_packages(): void
    {
        $category = Category::factory()->create();
        $data = Package::factory()
            ->make([
                'category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.packages.store', $category),
            $data
        );

        $this->assertDatabaseHas('packages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $package = Package::latest('id')->first();

        $this->assertEquals($category->id, $package->category_id);
    }
}
