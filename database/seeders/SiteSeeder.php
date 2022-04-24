<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Site::create([
            'site_name' => '志賀島 白瀬',
            'latitude' => 33.68151729911029,
            'longitude' => 130.3075921428407,
        ]);

        \App\Models\Site::create([
            'site_name' => '志賀島 黒瀬',
            'latitude' => 33.6870811731239,
            'longitude' => 130.304192393402,
        ]);

        \App\Models\Site::create([
            'site_name' => '福津 恋の浦',
            'latitude' => 33.80562178207481,
            'longitude' => 130.45027874985183,
        ]);

        \App\Models\Site::create([
            'site_name' => '唐津 KMSC前',
            'latitude' => 33.52217206191582,
            'longitude' => 129.95760827312105,
        ]);

        \App\Models\Site::create([
            'site_name' => '唐津 家康ポイント',
            'latitude' => 33.53762676305207,
            'longitude' => 129.87643723808398,
        ]);

        \App\Models\Site::create([
            'site_name' => '長崎 辰ノ口',
            'latitude' => 32.693549511252606,
            'longitude' => 129.79342026644613,
        ]);
    }
}
