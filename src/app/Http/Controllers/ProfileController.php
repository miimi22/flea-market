<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Profile;
use App\Models\Payment;
use App\Models\User;
use App\Models\TradingComment;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('edit', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        $user->name = $request->name;
        $user->save();

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images', $imageName);
            $profileImagePath = 'storage/images/' . $imageName;

            if ($profile && $profile->profile_image) {
                Storage::delete(str_replace('storage/', 'public/', $profile->profile_image));
            }
        } else {
            $profileImagePath = $profile ? $profile->profile_image : null;
        }

        if ($profile) {
            $profile->update([
                'profile_image' => $profileImagePath,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        } else {
            Profile::create([
                'user_id' => $user->id,
                'profile_image' => $profileImagePath,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        }

        return redirect('/mypage');
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $items = Item::where('user_id', $user->id)->get();
        $payments = Payment::where('user_id', $user->id)->with('item')->get();

        $trading_items = Item::withCount(['tradingComments as unread_messages_count' => function ($query) use ($user) {
            $query->where('user_id', '!=', $user->id);
        }])
        ->withMax('tradingComments', 'created_at')
        ->where(function ($query) use ($user) {
            $query->where('user_id', $user->id)->whereHas('payment');
        })
        ->orWhereHas('payment', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->orderBy('trading_comments_max_created_at', 'desc')
        ->get();

        $trading_message_count = $trading_items->sum('unread_messages_count');

        $ratingsQuery = Rating::where('evaluated_id', $user->id);
        $ratingCount = $ratingsQuery->count();
        $roundedRating = 0;

        if ($ratingCount > 0) {
            $averageRating = $ratingsQuery->avg('rating');
            $roundedRating = round($averageRating);
        }

        if (!$profile) {
            $profile = new Profile();
        }

        return view('profile', compact('user', 'profile', 'items', 'payments', 'trading_items', 'trading_message_count', 'ratingCount', 'roundedRating'));
    }
}
