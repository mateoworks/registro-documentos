<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['required']
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        $plainTextToken = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'email' => $user->email,
            'url_foto' => $user->getFoto(),
            'url_portada' => $user->getPortada(),
            'name' => $user->name,
            'role' => $user->getRoleNames(),
            'user_token' => $plainTextToken,
        ]);
    }
}
