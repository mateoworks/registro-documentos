<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'capturista']);
        })->included()->filter()->sort()->getOrPaginate();
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

        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        }
        if ($request->get('rol')) {
            $user->syncRoles($request->rol);
        }
        $user->update($data);

        return UserResource::make($user);
    }

    public function destroy(User $user)
    {
        $this->authorize('eliminar usuarios', Auth::user());
        $user->delete();
    }

    public function restore(Request $request)
    {
        $this->authorize('restaurar usuarios');
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        User::whereIn('id', $ids)->restore();
        return response()->json(['message' => 'Restauración exitosa']);
    }

    public function forceDelete(Request $request)
    {
        $this->authorize('forzar eliminacion usuarios');

        $ids = $request->input('ids');

        if (!is_array($ids)) {
            $ids = [$ids];
        }
        foreach ($ids as $id) {
            $carrera = User::withTrashed()->find($id);
            if ($carrera) {
                $carrera->forceDelete();
            }
        }
        return response()->json(['message' => 'Eliminación exitosa']);
    }

    public function indexTrashed()
    {
        $users = User::withTrashed()
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'capturista']);
            })
            ->onlyTrashed()
            ->included()
            ->get();
        return UserResource::collection($users);
    }

    private function storeFile(UploadedFile $file, $folder)
    {
        $filePath = $file->store($folder, 'public');
        return $filePath;
    }
}
