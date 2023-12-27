<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Comb Bind Notebook']);
        Category::create(['name' => 'Tape Bind Notebook']);
        Category::create(['name' => 'Certificate Printing']);
        Category::create(['name' => 'Thesis Hard Cover']);
        Category::create(['name' => 'Poster']);
    }
}
