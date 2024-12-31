<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SteamController extends Controller
{
    public function search(Request $request) {
        try {
            // キャッシュからゲームリストを取得（無ければAPI実行）
            $games = Cache::remember('steam_games_list', 86400, function () { // 24hキャッシュ
                // ログ出力を配列形式にする
                \Log::info('Steam APIへリクエスト開始', []); // ログにも空の配列を追加

                $response = Http::get('https://api.steampowered.com/ISteamApps/GetAppList/v2/');

            if (!$response->successful()) {
                \Log::error('Steam APIエラー: ' , ['response' => $response->body()]); // 配列でログ出力
                throw new \Exception('Steam APIからのデータ取得に失敗しました');
            }

            $data = $response->json();

            if (!isset($data['applist']['apps'])) {
                // エラーログも配列形式で
                \Log::error('Steam APIの予期しない応答形式: ', ['data' => json_encode($data)]); // ログ追加
                throw new \Exception('Steam APIからの予期しない応答形式です');
            }

            // UTF-8エンコーディングの処理をここで行う
            return array_map(function($game) {
                $game['name'] = mb_convert_encoding($game['name'], 'UTF-8', 'auto');
                return $game;
            }, $data['applist']['apps']);
        });
            

        $keyword = $request->query('q', '');

        if ($keyword) {
            // キーワードを小文字に統一すべく変換、ワードの前後の空白をトリム
            $keyword = mb_strtolower(trim($keyword));
            // ここも配列形式でログ出力
            \Log::info('検索キーワード:', ['keyword' => $keyword]);

            $filteredGames = array_filter($games, function($game) use ($keyword) {
                // mb_strposの戻り値をチェック
                return mb_strpos(mb_strtolower($game['name']), $keyword) !== false;
            });

            if (empty($filteredGames)) {
                return response()->json([
                    'data' => [],
                    'message' => '該当するゲームが見つかりませんでした。'
                ], 200);
            }

            // 結果を最初の10件のみに制限
            $filteredGames = array_slice($filteredGames, 0, 15);

            // タイトルと画像URLの抽出
            $pickedGames = array_map(function($game) {
                return [
                    'title' => $game['name'],
                    'img' => "https://steamcdn-a.akamaihd.net/steam/apps/{$game['appid']}/header.jpg"
                ];
            }, $filteredGames);

                return response()->json([
                    'data' => array_values($pickedGames) // indexを振り直して返す
                ]);                    
            }

            return response()->json(['data' => []]);

        } catch (\Exception $e) {
            \Log::error('検索処理エラー: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()  // エラーログも配列で
            ]);

            return response()->json([
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    // 画像URL検証メソッド
    public function verifyImageUrl($url) {
        try {
            $response = Http::head($url);
            return $response->successful() && str_contains($response->header('Content-Type'), 'image');
        } catch (\Exception $e) {
            return false;
        }
    }
}