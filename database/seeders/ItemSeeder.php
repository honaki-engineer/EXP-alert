<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 🔹 `public/` のデフォルト画像のパス
        $noImagePublicPath = public_path('image/noImage.jpg'); // `public/image/noImage.jpg`
        $santoriniPublicPath = public_path('image/サントリーニ島.jpg');

        // 🔹 `storage/` にコピーする先のパス
        $noImageStoragePath = storage_path('app/public/items/noImage.jpg');
        $santoriniStoragePath = storage_path('app/public/items/サントリーニ島.jpg');

        // 🔹 `items/` にデフォルト画像がなければコピー
        if (!File::exists($noImageStoragePath)) { File::copy($noImagePublicPath, $noImageStoragePath); }
        if (!File::exists($santoriniStoragePath)) { File::copy($santoriniPublicPath, $santoriniStoragePath); }

        DB::table('items')->insert([
            [
                'name' => 'アイス',
                'expiration_type' => '0',
                'deadline' => '2025-02-15',
                'comment' => '結構長い',
                'image_path' => 'サントリーニ島.jpg',
                'user_id' => 1,
            ],
            [
                'name' => 'ハンバーグ',
                'expiration_type' => '1',
                'deadline' => '2025-04-15',
                'comment' => '美味い',
                'image_path' => 'サントリーニ島.jpg',
                'user_id' => 1,
            ]
        ]);
    }
}
