<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function view()
    {
        return view('auth.login');
    }
    /**
     * Authenticate the user.
     *
     * @param Request
     */
    public function login(AuthLoginRequest $request)
    {
        try {
            if(!Auth::attempt($request->only(['email', 'password']))){
                return redirect()->back()->with('toastr', collect([
                    'type' => ['error'],
                    'message' => ['Email & Password does not match with our record'],
                ]));
            }

            $user = User::where('email', $request->email)->first();
            Auth::login($user);

            return redirect()->intended();

        } catch (\Throwable $th) {
            return redirect()->back()->with('toastr', collect([
                'type' => ['error'],
                'message' => [$th->getMessage()],
            ]));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
