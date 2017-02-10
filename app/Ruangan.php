<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $fillable = [
        'ruangan_nama',
        'desc'
    ];

     public function barang(){
                return $this->belongsToMany(
                    Barang::class,
                    'barang_ruangan',
                    'ruangan_id',
                    'barang_id'
                );
    }
}
