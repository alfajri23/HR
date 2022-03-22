<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BobotMultiOkr extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function divisi()
    {
        return $this->belongsTo(Subdivisi::class, 'id_sub', 'id')->where('bulan',$m);
    }
}
