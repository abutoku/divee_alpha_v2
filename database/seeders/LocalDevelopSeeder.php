<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocalDevelopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理者アカウント
        \App\Models\User::factory(1)->create([
            'name' => 'admin',
            'email'=> 'develop@example.com',
            'admin' => true,
        ]);

        // ユーザー作成
        \App\Models\Infomation::create([
            'shop_url' => 'https://gsacademy.jp',
            'user_id' => \App\Models\User::factory()->create([
                            'name' => 'Diveshop hogehoge',
                            'email'=> 'test@example.com'
                            ])->id
        ]);

        //ダイブサイト作成
        $this->call(SiteSeeder::class);

        //海況情報
        $this->call(SetdataSeeder::class);

    }
}
