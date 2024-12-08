<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;

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
            'image' => 'nullable'
        ]);

        $validated['user_id'] = auth()->id();

        $game = Games::create($validated);

        $request->session()->flash('message', '保存しました');
        return redirect()->route('stack.list');
    }

    public function list() {
        $games = Games::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(5);
        return view('stack.list', compact('games'));
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
            'image' => 'nullable'
        ]);

        $validated['user_id'] = auth()->id();

        $game->update($validated);
        
        return redirect()->route('game.show', compact('game'))->with('message', '更新しました');
    }

    public function destroy(Request $request, Games $game) {
        $game->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('stack.list');
    }
}
