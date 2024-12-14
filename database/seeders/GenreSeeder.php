<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            [
                'name' => 'JRPG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MMO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MOVA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PvP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PvE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'RPG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'TRPG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'VR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'アクション',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'アドベンチャー',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '一人称視点',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ヴァンサヴァライク',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ウォーキングシミュレーター',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'カードゲーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '格闘ゲーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '協力プレイ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'クラフト',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'クリッカー/放置',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'サウンドノベル',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'サバイバル',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'サンドボックス',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '三人称視点',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'シミュレーション',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'シューティング',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '推理',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ステルス',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'スポーツ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'サバイバルホラー',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '成人向け',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '選択型進行',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ゾンビ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'タワーディフェンス',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'テーブルゲーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'パーティー',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'パズル',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ハック＆スラッシュ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'バトルロワイアル',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ビジュアルノベル',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'プラットフォーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ポイント＆クリック',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ホラー',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '見下ろし型',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'メトロイドヴァニア',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'リアルタイム戦略',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'リズムゲーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '料理',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'レーシング',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '恋愛',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ローグライク',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Genre::insert($genres);

    }
}
