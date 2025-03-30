<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function purchase(Request $request, $item_id)
    {
        $item = Item::find($item_id);
        $user = Auth::user();
        $userProfile = Profile::where('user_id', $user->id)->first();
        return view('purchase', ['item' => $item, 'userProfile' => $userProfile]);
    }

    public function address($item_id)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $item = Item::find($item_id);
        return view('address', ['profile' => $profile, 'item' => $item]);
    }

    public function updateAddress(AddressRequest $request, $item_id)
    {
        $user = Auth::user();
        $profile = Profile::firstOrNew(['user_id' => $user->id]);

        $profile->post_code = $request->input('sending_code');
        $profile->address = $request->input('sending_address');
        $profile->building = $request->input('sending_building');
        $profile->save();

        return redirect()->route('purchase', ['item_id' => $item_id]);
    }

    public function stripe(PurchaseRequest $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $item = Item::find($request->item_id);
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->product_name,
                    ],
                    'unit_amount' => $item->product_price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item->id, 'payment_content' => $request->payment_content]),
            'cancel_url' => route('purchase', ['item_id' => $item->id]),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success(Request $request, $item_id, $payment_content)
    {
        $user = Auth::user();
        $item = Item::find($item_id);
        $profile = Profile::where('user_id', $user->id)->first();

        Payment::create([
            'content' => $payment_content,
            'user_id' => $user->id,
            'item_id' => $item->id,
            'sending_code' => $profile->post_code,
            'sending_address' => $profile->address,
            'sending_building' => $profile->building,
        ]);

        return redirect('/');
    }
}
