<?php

namespace App\Http\Controllers;

use App\Http\Requests\TradingCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionCompletedMail;
use App\Models\Item;
use App\Models\TradingComment;
use App\Models\Rating;

class TradingController extends Controller
{
    public function show($item_id)
    {
        $user = Auth::user();
        $item = Item::with(['user.profile', 'payment.user.profile'])->findOrFail($item_id);

        $isSeller = $user->id === $item->user_id;
        $isBuyer = $item->payment && $user->id === $item->payment->user_id;

        if (!$isSeller && !$isBuyer) {
            abort(403, 'このページにアクセスする権限がありません。');
        }

        $partner = $isSeller ? $item->payment->user : $item->user;

        $comments = TradingComment::where('item_id', $item_id)->with('user.profile')->orderBy('created_at', 'asc')->get();

        $all_trading_items = Item::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)->whereHas('payment');
        })
        ->orWhereHas('payment', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->get();

        $other_trading_items = $all_trading_items->where('id', '!=', $item_id);

        $buyerHasRated = false;
        if ($item->payment) {
            $buyerHasRated = Rating::where('item_id', $item_id)
                                   ->where('evaluator_id', $item->payment->user_id)
                                   ->exists();
        }
        
        $sellerHasRated = Rating::where('item_id', $item_id)
                                ->where('evaluator_id', $item->user_id)
                                ->exists();

        return view('trading', compact('item', 'user', 'partner', 'comments', 'isBuyer', 'isSeller', 'other_trading_items', 'buyerHasRated', 'sellerHasRated'));
    }

    public function storeComment(TradingCommentRequest $request, $item_id)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('trading_image')) {
            $path = $request->file('trading_image')->store('public/images');
            $imagePath = str_replace('public/', 'storage/', $path);
        }

        TradingComment::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'comment' => $validated['comment'],
            'trading_image' => $imagePath,
        ]);

        return back();
    }

    public function updateComment(TradingCommentRequest $request, TradingComment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->update($request->validated());

        return response()->json([
            'success' => true,
            'comment' => $comment->comment
        ]);
    }

    public function destroyComment(TradingComment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return back();
    }

    public function storeRating(Request $request, $item_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $item = Item::findOrFail($item_id);
        $user = Auth::user();

        $isSeller = $user->id === $item->user_id;
        $isBuyer = $item->payment && $user->id === $item->payment->user_id;

        if (!$isSeller && !$isBuyer) {
            abort(403, '評価する権限がありません。');
        }
        $evaluatedUser = $isSeller ? $item->payment->user : $item->user;

        $alreadyRated = Rating::where('item_id', $item_id)
                                ->where('evaluator_id', $user->id)
                                ->exists();
        if ($alreadyRated) {
            return back()->with('error', 'すでにこの取引の評価は完了しています。');
        }

        Rating::create([
            'evaluator_id' => $user->id,
            'evaluated_id' => $evaluatedUser->id,
            'item_id'      => $item->id,
            'rating'       => $request->rating,
        ]);

        if ($isBuyer) {
            $seller = $item->user;
            try {
                Mail::to($seller->email)->send(new TransactionCompletedMail($item, $seller));
            } catch (\Exception $e) {
                \Log::error('取引完了メールの送信に失敗しました。 EvaluatorID: ' . $user->id . ' ItemID: ' . $item->id . ' Error: ' . $e->getMessage());
            }
        }

        return redirect('/')->with('success', '取引相手の評価が完了しました。');
    }
}