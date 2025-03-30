<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function detail(Request $request, $item_id)
    {
        $item = Item::with('itemcategories', 'itemcategories.category', 'comments', 'comments.user.profile', 'likes')->find($item_id);
        $isLiked = false;

        if (Auth::check()) {
            $isLiked = $item->likes->where('user_id', Auth::id())->isNotEmpty();
        }

        return view('detail', compact('item', 'isLiked'));
    }

    public function sell(Request $request)
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $imagePath = $request->file('product_image')->store('public/images', 'local');

        $product = new Item();
        $product->user_id = Auth::id();
        $product->product_name = $request->input('product_name');
        $product->brand_name = $request->input('brand_name');
        $product->product_description = $request->input('product_description');
        $product->product_price = $request->input('product_price');
        $product->product_image = str_replace('public', 'storage', $imagePath);
        $product->condition_id = $request->input('content');
        $product->save();

        $product->categories()->attach($request->input('category'));

        return redirect('/');
    }
}
