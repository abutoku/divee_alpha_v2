<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetdataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Setdata::create([
            'site_name' => '志賀島 白瀬',
            'temp' => 14,
            'pc' => 40,//福岡県
            'hc' => 19,//西戸崎
            'jan' => 13,
            'feb' => 12,
            'mar' => 11,
            'apr' => 14,
            'may' => 18,
            'jun' => 20,
            'jul' => 23,
            'aug' => 25,
            'sep' => 27,
            'oct' => 23,
            'nov' => 18,
            'dec' => 16,
        ]);

        \App\Models\Setdata::create([
            'site_name' => '長崎 辰ノ口',
            'temp' => 15,
            'pc' => 42,//長崎県
            'hc' => 56,//伊王島
            'jan' => 15,
            'feb' => 15,
            'mar' => 14,
            'apr' => 16,
            'may' => 18,
            'jun' => 20,
            'jul' => 23,
            'aug' => 25,
            'sep' => 27,
            'oct' => 23,
            'nov' => 20,
            'dec' => 18,
        ]);

        \App\Models\Setdata::create([
            'site_name' => '唐津 KMSC前',
            'temp' => 13,
            'pc' => 41,//佐賀県
            'hc' => 1,//唐津
            'jan' => 13,
            'feb' => 12,
            'mar' => 12,
            'apr' => 16,
            'may' => 18,
            'jun' => 20,
            'jul' => 23,
            'aug' => 25,
            'sep' => 27,
            'oct' => 23,
            'nov' => 19,
            'dec' => 16,
        ]);

        \App\Models\Setdata::create([
            'site_name' => '呼子 家康ポイント',
            'temp' => 13,
            'pc' => 41,//佐賀県
            'hc' => 3,//名護屋浦
            'jan' => 13,
            'feb' => 12,
            'mar' => 12,
            'apr' => 16,
            'may' => 18,
            'jun' => 20,
            'jul' => 23,
            'aug' => 25,
            'sep' => 25,
            'oct' => 23,
            'nov' => 19,
            'dec' => 15,
        ]);

        
    }
}
