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

        $paymentMethod = $request->payment_content;

        try {
            if ($paymentMethod === 'カード支払い') {
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
                    'success_url' => route('purchase.success', ['item_id' => $item->id, 'payment_content' => $paymentMethod]),
                    'cancel_url' => route('purchase', ['item_id' => $item->id]),
                ]);
            } elseif ($paymentMethod === 'コンビニ払い') {
                $session = Session::create([
                    'payment_method_types' => ['konbini'],
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
                    'success_url' => route('purchase.success', ['item_id' => $item->id, 'payment_content' => $paymentMethod]),
                    'cancel_url' => route('purchase', ['item_id' => $item->id]),
                ]);
            } else {
                return response()->json(['error' => '支払い方法が不正です。']);
            }

            return response()->json(['id' => $session->id]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request, $item_id, $payment_content)
    {
        $user = Auth::user();
        $item = Item::find($item_id);
        $profile = Profile::where('user_id', $user->id)->first();

        try {
            Payment::create([
                'content' => $payment_content,
                'user_id' => $user->id,
                'item_id' => $item->id,
                'sending_code' => $profile->post_code,
                'sending_address' => $profile->address,
                'sending_building' => $profile->building,
            ]);

            return redirect('/');
        } catch (\Exception $e) {
            \Log::error('Payment creation failed: ' . $e->getMessage());
            return redirect('/')->with('error', '支払い情報の保存に失敗しました。');
        }
    }
}
