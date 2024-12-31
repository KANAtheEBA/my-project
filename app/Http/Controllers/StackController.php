<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class StackController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|max:255',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
            'launch_date' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'developer' => 'nullable|max:255',
            'publisher' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'steam_image_url' => 'nullable|url' // Steam画像がある場合のバリエーション
        ]);

        $validated['user_id'] = auth()->id();

        // Steam画像URLが提供されている場合、画像をダウンロード
        if (!empty($validated['steam_image_url'])) {
            try {
                $steamController = new SteamController();
                if ($steamController->verifyImageUrl($validated['steam_image_url'])) {
                    $imageContent = Http::get($validated['steam_image_url'])->body();
                    $fileName = 'steam_' . now()->format('YmdHis') . '_' . uniqid() . '.jpg';
                    Storage::disk('public')->put('images/' . $fileName, $imageContent);
                    $validated['image'] = $fileName;
                    \Log::info('画像保存パス:', [
                        'fileName' => $fileName,
                        'fullPath' => Storage::path('images/' . $fileName)
                    ]);
                    // 保存後、もう一度パス確認
                    if (storage::disk('public')->exists('public/images/' . $fileName)) {
                        \Log::info('ファイル保存成功:', ['fileName' => $fileName]);
                    } else {
                        \Log::error('ファイル保存失敗:', ['fileName' => $fileName]);
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Steam画像ダウンロードエラー:', [
                    'url' => $validated['steam_image_url'],
                    'error' => $e->getMessage()
                ]);
            }
        } elseif ($request->hasFile('image')) {
            $file = $request->file('image');
            // オリジナルファイル名から拡張子を取得
            $extension = $file->getClientOriginalExtension();
            // 現在の日時を使用してユニークなファイル名を生成
            $fileName = now()->format('YmdHis') . '_' . uniqid() . '.' . $extension;
            // 画像を保存
            $file->storeAs('images', $fileName, 'public');
            // データベースに保存するパスを設定
            $validated['image'] = $fileName;
        }

        unset($validated['steam_image_url']); // DB保存前に不要なフィールドを削除

        $game = Game::create($validated);

        if($request->has('genres')) {
            $game->genres()->attach($request->genres);
        }

        return redirect()->route('stack.list')->with('message', '保存しました');
    }

    public function create() {
        $genres = Genre::all();
        // Steam API感染の設定
        $config = [
            'maxFileSize' => config('app.max_upload_size', 1024), // KB単位
            'allowedExtensions' => ['jpg', 'jpeg', 'png'],
            'imagePreviewId' => 'image-preview',
            'defaultImageUrl' => asset('img/no-image.png'), // 画像プレビューエリアのダミー画像(public/imgに配置)
        ];
        return view('stack.create', compact('genres', 'config'));
    }

    public function list() {
        $user = auth()->user();
        $games = Game::where('user_id', auth()->id())
            ->with('genres') //イーガーローディングでリレーションを一緒に取得
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // 所有ゲーム数をカウント
        $gameCount = Game::where('user_id', auth()->id())->count();

        // ゲーム数に応じた画像パスを設定
        if ($gameCount === 0) {
            $imagePath = asset('img/level0.jpg'); // 所有数0
            $rank = "荒野";
        } elseif ($gameCount === 1) {
            $imagePath = asset('img/level1.jpg'); // 所有数1
            $rank = "雨";
        } elseif ($gameCount >= 2 && $gameCount <= 4) {
            $imagePath = asset('img/level2.jpg'); // 所有数2-4
            $rank = "川";
        } elseif ($gameCount >= 5 && $gameCount <= 7) {
            $imagePath = asset('img/level5.jpg'); // 所有数5-7
            $rank = "蕾";
        } elseif ($gameCount >= 8 && $gameCount <= 10) {
            $imagePath = asset('img/level8.jpg'); // 所有数8-10
            $rank = "開花";
        } elseif ($gameCount >= 11 && $gameCount <= 14) {
            $imagePath = asset('img/level11.jpg'); // 所有数11-14
            $rank = "繁茂";
        } else {
            $imagePath = asset('img/level15.jpg'); // 所有数15以上
            $rank = "結実";
        }

        return view('stack.list', compact('games', 'user', 'imagePath', 'rank'));
        
    }

    public function show(Game $game) {
        return view('stack.show', compact('game'));
    }

    public function edit(Game $game) {
        $genres = Genre::all();
        return view('stack.edit', compact('game', 'genres'));
    }

    public function update(Request $request, Game $game) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|max:255',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',
            'launch_date' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'developer' => 'nullable|max:255',
            'publisher' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        //古い画像ファイルを保持
        $oldImageFileName = $game->image;

        if ($request->hasFile('image')) {

            if ($oldImageFileName) {
                // ストレージから古い画像を削除
                Storage::disk('public')->delete('images/' . $oldImageFileName);
            }
            // 新しい画像を保存
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = now()->format('YmdHis') . '_' . uniqid() . '.' . $extension;
            // 画像を保存
            $file->storeAs('images', $fileName, 'public');
            // データベースに保存するパスを設定
            $validated['image'] = $fileName;

        }

        $validated['user_id'] = auth()->id();

        $game->update($validated);

        if ($request->has('genres')) {
            $game->genres()->sync($request->genres);
        } else {
            // ジャンルが選択されていない場合は、既存のジャンルをすべて削除
            $game->genres()->detach();
        }
        
        return redirect()->route('game.show', compact('game'))->with('message', '更新しました');
    }

    public function destroy(Request $request, Game $game) {
        //画像が存在する場合に削除
        if ($game->image) {
            
            Storage::disk('public')->delete('images/' . $game->image);
        }
        $game->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('stack.list');
    }
}
