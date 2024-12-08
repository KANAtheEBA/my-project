<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Games::create([
            'title' => 'テストテストテスト',
            'platform' => 'PlayStation5',
            'genre' => 'メトロイドヴァニア',
            'launch_date' => '2021/10/31',
            'purchase_date' => '2023/01/01',
            'developer' => 'テスト開発株式会社',
            'publisher' => 'テスト出版',
            'user_id' => '2',
        ]);
    }
}
