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
                \Log::info('Steam APIへリクエスト開始'); // ログ追加

                $response = Http::get('https://api.steampowered.com/ISteamApps/GetAppList/v2/');

            if (!$response->successful()) {
                \Log::error('Steam APIエラー: ' . $response->body()); // ログ追加
                throw new \Exception('Steam APIからのデータ取得に失敗しました');
            }



            $data = $response->json();

            if (!isset($data['applist']['apps'])) {
                \Log::error('Steam APIの予期しない応答形式: ' . json_encode($data)); // ログ追加
                throw new \Exception('Steam APIからの予期しない応答形式です');
            }

            return $data['applist']['apps'];

            $games = array_map(function($game) {
                $game['name'] = mb_convert_encoding($game['name'], 'UTF-8', 'auto');
                return $game;
            }, $games);
        });

        $keyword = $request->query('q', '');

        if ($keyword) {
            // キーワードを小文字に統一すべく変換、ワードの前後の空白をトリム
            $keyword = mb_strtolower(trim($keyword));

            $filteredGames = array_filter($games, function($game) use ($keyword) {
                return mb_strpos(mb_strtolower($game['name']), $keyword);
                \Log::info('検索対象データ:', $games);
            });

            if (empty($filteredGames)) {
                return response()->json(['message' => '該当するゲームが見つかりませんでした。'], 200);
            }

            // 結果を最初の10件のみに制限
            $filteredGames = array_slice($filteredGames, 0, 10);

            // タイトルと画像URLの抽出
            $pickedGames = array_map(function($game) {
                return [
                    'title' => $game['name'],
                    'img' => "https://steamcdn-a.akamaihd.net/steam/apps/{$game['appid']}/header.jpg"
                ];
            }, $filteredGames);

                return response()->json(array_values($pickedGames)); // indexを振り直して返す
            }

            return response()->json([]);
        } catch (\Exception $e) {
            \Log::error('検索処理エラー: ' . $e->getMessage()); // ログ追加
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }
}
