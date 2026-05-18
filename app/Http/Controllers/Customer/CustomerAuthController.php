<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class CustomerAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('customer.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | MANUAL LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $credentials = $request->validate([

            'email' => ['required', 'email'],

            'password' => ['required'],

        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // ROLE CHECK
            if (auth()->user()->role !== 'customer') {

                Auth::logout();

                return back()->with(
                    'error',
                    'Unauthorized access.'
                );
            }

            return redirect()
                ->route('customer.home');
        }

        return back()->with(
            'error',
            'Invalid credentials.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GOOGLE REDIRECT
    |--------------------------------------------------------------------------
    */

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /*
    |--------------------------------------------------------------------------
    | GOOGLE CALLBACK
    |--------------------------------------------------------------------------
    */

    public function googleCallback()
    {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();

        $user = User::firstOrCreate(

            [
                'email' => $googleUser->getEmail(),
            ],

            [
                'name' => $googleUser->getName(),

                'password' => bcrypt('google-auth'),

                'role' => 'customer',
            ]

        );

        Auth::login($user);

        return redirect()
            ->route('customer.home');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('customer.login');
    }
}