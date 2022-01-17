<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Divisi extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $guarded = [];

    public function users(){
    	return $this->hasMany(User::class, 'id_divisi', 'id');
    }
    
}
