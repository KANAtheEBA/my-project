<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;
use Illuminate\Support\Facades\Storage;

class StackController extends Controller
{
    public function create() {
        return view('stack.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|max:255',
            'genre' => 'required|max:255',
            'launch_date' => 'nullable|date',
            'purchase_date' => 'nullable|date',
            'developer' => 'nullable|max:255',
            'publisher' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $validated['user_id'] = auth()->id();

        if($request->hasFile('image')) {
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

        $game = Games::create($validated);

        $request->session()->flash('message', '保存しました');
        return redirect()->route('stack.list');
    }

    public function list() {
        $games = Games::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(5);
        $user = auth()->user();
        return view('stack.list', compact('games', 'user'));
    }

    public function show(Games $game) {
        return view('stack.show', compact('game'));
    }

    public function edit(Games $game) {
        return view('stack.edit', compact('game'));
    }

    public function update(Request $request, Games $game) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'platform' => 'required|max:255',
            'genre' => 'required|max:255',
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
                Storage::disk('public')->delete('image/' . $oldImageFileName);
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
        
        return redirect()->route('game.show', compact('game'))->with('message', '更新しました');
    }

    public function destroy(Request $request, Games $game) {
        //画像が存在する場合に削除
        if ($game->image) {
            Storage::delete('public/images/' . $game->image);
        }
        $game->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('stack.list');
    }
}
