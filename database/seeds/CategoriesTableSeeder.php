<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'php'], ['name' => 'laravel'], ['name' => 'jquery'], ['name' => 'vue'], ['name' => 'react'],
            ['name' => 'html'], ['name' => 'css'], ['name' => 'javascript'], ['name' => 'mysql'], ['name' => 'linux']
        ];

        \DB::table('categories')->insert($categories);
    }
}
