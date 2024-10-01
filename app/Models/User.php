<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nis',
        'email',
        'gambar',
        'role',
        'text_password',
        'password',
        'is_master',
        'is_kepala_sekolah',
        'is_kepala_perpus'
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

    public function scopeFilters($query, $filter)
    {

        $query->when($filter ?? false, function ($query, $filter) {
            return $query->where('name', 'LIKE', '%' . $filter . '%')
                ->orWhere('email', 'LIKE', '%' . $filter . '%')
                ->orWhere('nis', 'LIKE', '%' . $filter . '%');
        });

    }

    public function scopeSiswa($query)
    {
        return $query->where('role', 'siswa');
    }

    public function scopePetugas($query)
    {
        return $query->where('role', 'petugasr')
            ->get();
    }
}
