<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => 'アイス',
                'expiration_type' => '0',
                'deadline' => '2025-02-15',
                'comment' => '結構長い',
                'image_path' => 'items/サントリーニ島.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'ハンバーグ',
                'expiration_type' => '1',
                'deadline' => '2025-04-15',
                'comment' => '美味い',
                'image_path' => 'items/サントリーニ島.jpg',
                'user_id' => 1,
            ]
        ]);
    }
}
