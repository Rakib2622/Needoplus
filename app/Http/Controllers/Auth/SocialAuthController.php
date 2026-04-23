<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google
     */
    public function redirectToGoogle(Request $request)
    {
        // 🔥 Store referral BEFORE redirecting to Google
        if ($request->has('ref')) {
            session(['referral_code' => $request->ref]);
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google Callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            /**
             * 🔍 Check if user already exists
             */
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
            } else {

                /**
                 * 🔥 Generate UNIQUE referral code
                 */
                do {
                    $referralCode = 'NEEDO' . rand(10000, 99999);
                } while (User::where('referral_code', $referralCode)->exists());

                /**
                 * 🔥 Create user
                 */
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()),

                    'email_verified_at' => now(),
                    'referral_code' => $referralCode,
                ]);

                Auth::login($user);
            }

            /**
             * 🔥 IMPORTANT: go to referral page (not home)
             */
            return redirect()->route('referral.complete');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Google login failed. Try again.');
        }
    }
}