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
        Category::create([
            'name' => 'Comb Bind Notebook',
            'image' => 'assets/images/comb_bind_notebook.jpg'
        ]);

        Category::create([
            'name' => 'Tape Bind Notebook',
            'image' => 'assets/images/tape_bind_notebook.jpg'
        ]);

        Category::create([
            'name' => 'Certificate Printing',
            'image' => 'assets/images/certificate_printing.jpg'
        ]);

        Category::create([
            'name' => 'Thesis Hard Cover',
            'image' => 'assets/images/thesis_hard_cover.jpg'
        ]);

        Category::create([
            'name' => 'Poster',
            'image' => 'assets/images/poster.jpg'
        ]);
    }
}
