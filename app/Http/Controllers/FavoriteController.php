<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required',
            'favoritable_type' => 'required',
        ]);

        $favorite = Favorite::where('user_id', auth()->id())
            ->where('favoritable_id', $request->favoritable_id)
            ->where('favoritable_type', $request->favoritable_type)
            ->first();

        if ($favorite) {
            $favorite->delete();

return back()->with('success', __('messages.removed_from_favorites'));        }

        Favorite::create([
            'user_id' => auth()->id(),
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $request->favoritable_type,
        ]);

return back()->with('success', __('messages.added_to_favorites'));    }
}