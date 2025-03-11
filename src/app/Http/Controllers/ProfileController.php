<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function edit(ProfileRequest $request)
    {
        return view('edit');
    }

    public function profile()
    {
        return view('profile');
    }
}
