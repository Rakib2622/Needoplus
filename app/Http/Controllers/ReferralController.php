<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    /**
     * Show referral capture page after login
     */
    public function index()
    {
        return view('referral.complete');
    }

    /**
     * Save referral code
     */
    public function store(Request $request)
    {
        $request->validate([
            'referral_code' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();

        // If user already has referrer, skip
        if ($user->referred_by) {
            return redirect()->route('home');
        }

        $refCode = $request->referral_code;

        if (!empty($refCode)) {

            $refUser = User::where('referral_code', $refCode)->first();

            // prevent invalid or self referral
            if ($refUser && $refUser->id !== $user->id) {
                $user->referred_by = $refUser->id;
                $user->save();
            }
        }

        return redirect()->route('home');
    }
}