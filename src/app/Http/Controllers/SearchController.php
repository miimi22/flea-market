<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }

        if ($request->input('tab') === 'mylist' && Auth::check()) {
            $user = Auth::user();
            $likedItemIds = $user->likes->pluck('item_id')->toArray();
            $query->whereIn('id', $likedItemIds);
        }

        $items = $query->get();

        return view('item', ['items' => $items, 'keyword' => $request->input('keyword'), 'tab' => $request->input('tab')]);
    }
}
