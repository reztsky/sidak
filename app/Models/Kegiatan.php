<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table='kegiatan';

    public function scopeKegiatans($query){
        return $query->where('id_user',Auth::user()->id);
    }
}
