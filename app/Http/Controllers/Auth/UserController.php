<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

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
        $this->authorize('view', Auth::user());
        $user = User::included()->findOrFail($id);
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', Auth::user());
        $user->update($request->all());
        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', Auth::user());
        $user->delete();
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }
}
