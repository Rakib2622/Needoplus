<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    /**
     * 🔥 Generate UNIQUE referral code
     */
    do {
        $referralCode = 'NEEDO+' . rand(10000, 99999);
    } while (User::where('referral_code', $referralCode)->exists());

    /**
     * 🔥 Check referral from request (?ref=NEEDO12345)
     */
    $refCode = $request->ref ?? null;
    $referredBy = null;

    if (!empty($refCode)) {
        $refUser = User::where('referral_code', $refCode)->first();

        if ($refUser) {
            $referredBy = $refUser->id;
        }
    }

    /**
     * 🔥 Create user
     */
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),

        // Referral system
        'referral_code' => $referralCode,
        'referred_by' => $referredBy,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('home');
}
}