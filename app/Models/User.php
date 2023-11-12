<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles, SoftDeletes, ApiTrait;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $allowIncluded = ['roles', 'roles.permissions'];
    protected $allowFilter = ['name', 'email'];
    protected $allowSort = ['name', 'email', 'created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'url_foto',
        'url_portada',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();

        static::forceDeleted(function ($user) {
            if ($user->url_foto) {
                if (Storage::disk('public')->exists($user->url_foto))
                    Storage::disk('public')->delete($user->url_foto);
            }
            if ($user->url_portada) {
                if (Storage::disk('public')->exists($user->url_portada))
                    Storage::disk('public')->delete($user->url_portada);
            }
        });
    }

    public function getFoto()
    {
        if ($this->url_foto) {
            if (Storage::disk('public')->exists($this->url_foto))
                return Storage::disk('public')->url($this->url_foto);
        } else
            return Storage::disk('public')->url('profile1.jpg');
    }


    public function getPortada()
    {
        if ($this->url_portada) {
            if (Storage::disk('public')->exists($this->url_portada))
                return Storage::disk('public')->url($this->url_portada);
        } else
            return Storage::disk('public')->url('cover1.jpg');
    }

    public function role()
    {
        return $this->hasMany(Role::class);
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'user_id');
    }
}
