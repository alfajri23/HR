<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OkrTracking extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $guarded = [];

    public function keyResult(){
    	return $this->belongsTo(Keyresult::class, 'kode_key', 'kode');
    }

    public function keyResultUser(){
    	return $this->belongsTo(KeyResultUser::class, 'id_key_result_user', 'id');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'username', 'username');
    }
}
