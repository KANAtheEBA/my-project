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

        return back()->with('message', '保存しました');
    }
}
