<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view()
    {
        return view('auth.register');
    }

    /**
     * Register a newly user.
     *
     * @param Request $request
     */
    public function register(AuthRegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('auth.login')->with('toastr', [
                'type' => ['success'],
                'message' => ['Registrado com sucesso!'],
            ]);

        } catch (\Throwable $th) {
            return redirect()->back()->with('toastr', collect([
                'type' => ['error'],
                'message' => [$th->getMessage()],
            ]));
        }
    }
}
