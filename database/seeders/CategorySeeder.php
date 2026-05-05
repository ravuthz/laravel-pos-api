<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main category ( no parent )
        Category::factory(10);

        // Create sub category that random parent above
        Category::factory(15)->create()->each(function (Category $category) {
            $category->parent_id = Category::inRandomOrder()->first()->id;
            $category->save();
        });
    }
}
