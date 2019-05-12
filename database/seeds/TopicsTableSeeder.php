<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Category;
use App\Models\User;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 faker 实例
        $faker = app(Faker::class);
        // 获取所有用户
        $userIds = User::all()->pluck('id')->toArray();
        // 获取所有分类
        $categoryIds = Category::all()->pluck('id')->toArray();

        $topics = factory(Topic::class)
                ->times(100)
                ->make()
                ->each(function($topic, $index) use($faker, $userIds, $categoryIds) {
                    $topic->user_id = $faker->randomElement($userIds);
                    $topic->category_id = $faker->randomElement($categoryIds);
                })->toArray();

        Topic::insert($topics);

    }
}
