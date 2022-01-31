<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id');
    }

    public function keyResult()
    {
        return $this->hasMany(KeyResultUser::class, 'username', 'username');
    }

    public function ibadah()
    {
        return $this->hasMany(ListIbadahUser::class, 'id', 'id_user');
    }

    public function keyResults()
    {
        return $this->hasMany(KeyResultUser::class, 'id_user', 'id');
    }

    public function track()
    {
        return $this->hasMany(OkrTracking::class, 'username', 'username');
    }

    public function absens()
    {
        return $this->hasMany(Absensi::class, 'id_user', 'id');
    }

    // public function track()
    // {
    //     return $this->hasMany(OkrTracking::class, 'id_user', 'id');
    // }

    public function top()
    {
        return $this->hasMany(TopOfMount::class, 'id_user', 'id');
    }

    public function izin()
    {
        return $this->hasMany(Izin::class, 'id_user', 'id');
    }

    public function ganti_jam()
    {
        return $this->hasMany(GantiJam::class, 'id_user', 'id');
    }

    public function lembur()
    {
        return $this->hasMany(LemburKerja::class, 'id_user', 'id');
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'nama',
    //     'email',
    //     'telepon',
    //     'alamat',
    //     'password',
    // ];

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
    ];
}
