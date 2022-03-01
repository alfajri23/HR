<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objective extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $guarded = [];

    public function keyResult(){
    	return $this->hasMany(Keyresult::class, 'kode_obj', 'kode')->orderBy('kode', 'ASC');
    }

    public function divisi(){
    	return $this->belongsTo(Divisi::class, 'id_divisi', 'id');
    }
}
