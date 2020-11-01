<?php

namespace App\Http\Controllers\Auth\Oauth;

use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class GithubController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGithubCallback()
    {
        try {
            $socialUser = Socialite::driver('github')->user();
            $user = User::where('github_id', $socialUser->id)->first();

            if($user){
                Auth::login($user);
                return redirect()->intended('dashboard');
            }else{
                $newUser = User::create([
                    'name' => $socialUser->nickname ?? $socialUser->name ?? $socialUser->email,
                    'email' => $socialUser->email,
                    'github_id'=> $socialUser->id,
                    'password' => Hash::make(random_bytes(12))
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            Log::error('handleGithubCallbackError ' . $e->getMessage());

            return redirect('/login')->with('status', $e->getMessage());
        }
    }
}
