<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserEditController extends Controller
{
    public function editarPortada(Request $request)
    {
        $request->validate(['url_portada' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
        $user = auth()->user();
        if ($request->hasFile('url_portada')) {
            if ($user->url_portada) {
                Storage::disk('public')->delete($user->url_portada);
            }
            $urlCover = $this->storeFile($request->file('url_portada'), 'portada');
        }
        $user->update([
            'url_portada' => $urlCover
        ]);
        return UserResource::make($user);
    }

    public function editarAvatar(Request $request)
    {
        $request->validate(['url_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
        $user = auth()->user();
        if ($request->hasFile('url_foto')) {
            if ($user->url_foto) {
                Storage::disk('public')->delete($user->url_foto);
            }
            $urlAvatar = $this->storeFile($request->file('url_foto'), 'perfil');
        }
        $user->update([
            'url_foto' => $urlAvatar
        ]);
        return UserResource::make($user);
    }

    public function editarName(Request $request)
    {
        $request->validate(['name' => 'required']);
        $user = auth()->user();

        $user->update([
            'name' => $request->name
        ]);
        return UserResource::make($user);
    }

    public function editarPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'errors' => [
                    'custom_error' => ['La contraseña actual no coincide.'],
                ],
                'message' => 'La contraseña actual no coincide.',
            ], 422);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return UserResource::make($user);
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }
}
