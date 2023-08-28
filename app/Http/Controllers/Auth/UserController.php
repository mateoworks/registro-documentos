<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('ver usuarios', Auth::user());
        $users = User::included()->filter()->sort()->getOrPaginate();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize('crear usuarios', Auth::user());

        $data = $request->all();

        $data['password'] = bcrypt($data['password']);

        if ($request->hasFile('url_foto')) {
            $data['url_foto'] = $this->storeFile($request->file('url_foto'), 'perfil');
        }

        if ($request->hasFile('url_portada')) {
            $data['url_portada'] = $this->storeFile($request->file('url_portada'), 'portada');
        }

        $user = User::create($data);
        if ($request->get('rol')) {
            $user->assignRole($request->rol);
        }

        $user->load('roles');
        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('ver usuarios', Auth::user());
        $user = User::included()->findOrFail($id);
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('editar usuarios', Auth::user());
        $data = $request->all();

        if ($request->hasFile('url_foto')) {
            if ($user->url_foto) {
                Storage::disk('public')->delete($user->url_foto);
            }
            $data['url_foto'] = $this->storeFile($request->file('url_foto'), 'perfil');
        }

        if ($request->hasFile('url_portada')) {
            if ($user->url_portada) {
                Storage::disk('public')->delete($user->url_portada);
            }
            $data['url_portada'] = $this->storeFile($request->file('url_portada'), 'perfil');
        }

        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return UserResource::make($user);
    }

    public function destroy(User $user)
    {
        $this->authorize('eliminar usuarios', Auth::user());
        $user->delete();
    }

    public function restore($user)
    {
        $this->authorize('restaurar usuarios');
        $restoredUser = User::withTrashed()->findOrFail($user);
        $restoredUser->restore();
        return UserResource::make($restoredUser);
    }

    public function forceDelete(User $user)
    {
        $this->authorize('forzar eliminacion usuarios');

        if ($user->url_foto) {
            Storage::disk('public')->delete($user->url_foto);
        }
        if ($user->url_portada) {
            Storage::disk('public')->delete($user->url_portada);
        }
        $user->forceDelete();
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }
}
