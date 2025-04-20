<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'content' => '商品のお届けについて',
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'content' => '商品の交換について',
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'content' => '商品トラブル',
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'content' => 'ショップへのお問い合わせ',
        ]);

        DB::table('categories')->insert([
            'id' => 5,
            'content' => 'その他',
        ]);

    }
}
