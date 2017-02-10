<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table        = 'barang';
    protected $fillable     = [
        'nama_barang','desc','status','status_keterangan','total','tgl_masuk','barcode','kategori_id','jurusan_id','harga'
    ];

    public function ruangan(){
                return $this->belongsToMany(
                    Ruangan::class,
                    'barang_ruangan',
                    'ruangan_id',
                    'barang_id'
                );
    }

    public function supplier()
    {
             return $this->belongsToMany(
                    Ruangan::class,
                    'supplier_barang',
                    'supplier_id',
                    'barang_id'
                );
    }
}
