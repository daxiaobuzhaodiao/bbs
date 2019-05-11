<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
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
        // 头像假数据
        $avatars = [
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];
        // 生成数据集合
        $users = factory(User::class)
                ->times(10)
                ->make()
                ->each(function($user) use($faker, $avatars) {
                    $user->avatar = $faker->randomElement($avatars);
                });
        // 让隐藏字段可见，并将数据集合转换为数组
        $users = $users->makeVisible(['password', 'remember_token'])->toArray();
        // 插入到数据库中
        \DB::table('users')->insert($users);

        // 定制id为1的用户
        $user = User::find(1);
        $user->name = 'manager';
        $user->email = 'fit_top@163.com';
        $user->avatar = 'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->save();

    
    }
}