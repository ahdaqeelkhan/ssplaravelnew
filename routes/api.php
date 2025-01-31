<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



Route::post('/register',  function (Request $request) {
    
    $user = new User([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $user->save();

    return response()->json([
        'message' => 'Successfully created user!',
    ], 201);
});

Route::post('/login', function (Request $request) {
    // Validate the request
    
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    

    // Find the user by email
    $user = User::where('email', $validated['email'])->first();
    
    // Log user for debugging
    Log::info('User credentials:', ['email' => $validated['email']]);
    Log::info('User found:', ['user' => $user]);
    
    // Check if the user exists and the password is correct
    if (!$user || !Hash::check($validated['password'], $user->password)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Generate a token for the user
    //$token = $user->createToken('authToken', ['*']); // '*' grants all abilities
    $token = $user->id;
    // Log the generated token for debugging
    //Log::info('Generated Token:', ['token' => $token->plainTextToken]);

    return response()->json([
        'message' => 'Login successful',
        'user' => $user,
        'token' => $token,
    ], 200);
});
