<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Update the role of a user to 'admin' by email.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAdminRole()
    {
        // find the admin email
        $user = User::where('email', 'admin@gmail.com')->first();

        if ($user) {
            // Update the role to 'admin'
            $user->role = 'admin';
            $user->save();

            return response()->json(['message' => 'User role updated to admin successfully!'], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
