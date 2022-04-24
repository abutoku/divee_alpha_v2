<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Profile::factory(2)->create([
            'card_rank' => 'Pro',
            'dive_count' =>5000,
            'shop_id' =>1,
        ]);

        \App\Models\Profile::factory(6)->create([
            'card_rank' => 'DM',
            'shop_id' =>1,
        ]);

        \App\Models\Profile::factory(10)->create([
            'card_rank' => 'MSD',
            'shop_id' =>1,
        ]);

        \App\Models\Profile::factory(8)->create([
            'card_rank' => 'AOW',
            'shop_id' =>1,
        ]);

        \App\Models\Profile::factory(4)->create([
            'card_rank' => 'OW',
            'shop_id' =>1,
        ]);

    }
}
