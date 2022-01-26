<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Divisi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function users(){
    	return $this->hasMany(User::class, 'id_divisi', 'id');
    }

    public function objectives(){
    	return $this->hasMany(Objective::class, 'id_divisi', 'id');
    }

    public function manager(){
    	return $this->hasOne(User::class, 'id', 'id_manager');
    }
    
}
