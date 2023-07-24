<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return array<User>
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'data' => [
                'users' => $users,
            ],
        ], 200);
    }

    /**
     * Display the specified user.
     *
     * @return User
     */
    public function show(User $user)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'user' => $user,
            ],
        ], 200);
    }
}
