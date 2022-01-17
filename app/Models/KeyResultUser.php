<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeyResultUser extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function track(){
    	return $this->hasMany(OkrTracking::class, 'id_key_result_user', 'id');
    }

    public function keyResult()
    {
        return $this->hasMany(Keyresult::class, 'kode_key', 'kode');
    }
}
