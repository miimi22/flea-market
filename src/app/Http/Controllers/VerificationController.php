<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function showNotice()
    {
        return view('verification');
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::find($id);

        if (!$user || !hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect('/login')->with('error', '無効なURLです。');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/mypage/profile')->with('success', 'メールアドレスは既に認証済みです。');
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect('/mypage/profile')->with('success', 'メールアドレスの認証が完了しました。');
    }

    public function resend(Request $request)
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect('/mypage/profile')->with('success', 'メールアドレスは既に認証済みです。');
        }

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addHour(),
            ['id' => Auth::id(), 'hash' => sha1(Auth::user()->getEmailForVerification())]
        );

        Mail::to(Auth::user()->email)->send(new VerifyEmail($verificationUrl));

        return redirect()->route('verification.notice')->with('success', '認証メールを再送しました。');
    }
}