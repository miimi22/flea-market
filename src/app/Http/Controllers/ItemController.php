<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExhibitionRequest;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('item', ['items' => $items]);
    }

    public function detail(CommentRequest $request, $item_id)
    {
        $item = Item::find($item_id);
        return view('detail', compact('item'));
    }

    public function sell(ExhibitionRequest $request)
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', ['categories' => $categories, 'conditions' => $conditions]);
    }
}
