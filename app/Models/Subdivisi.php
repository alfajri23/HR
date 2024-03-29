<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subdivisi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function bobot($m)
    {
        return $this->hasMany(BobotMultiOkr::class, 'id_sub', 'id')->where('bulan',$m);
    }
}
