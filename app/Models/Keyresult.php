<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyresult extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $guarded = [];

    public function objective(){
    	return $this->belongsTo(Objective::class, 'kode_obj', 'kode');
    }

    public function keyResultUser()
    {
        return $this->belongsTo(KeyResultUser::class, 'kode', 'kode_key');
    }

    public function track()
    {
        return $this->hasMany(OkrTracking::class, 'kode_key', 'kode');
    }
}
