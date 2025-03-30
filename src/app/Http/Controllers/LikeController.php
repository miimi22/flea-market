<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request, $item_id)
    {
        $user_id = Auth::id();

        $like = Like::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create(['user_id' => $user_id, 'item_id' => $item_id]);
            $liked = true;
        }

        $likeCount = Like::where('item_id', $item_id)->count();

        return response()->json(['liked' => $liked, 'likeCount' => $likeCount]);
    }
}
