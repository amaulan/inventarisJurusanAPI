<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table        = 'barang';
    protected $fillable     = [
        'nama_barang','desc','status','status_keterangan','total','tgl_masuk','barcode','kategori_id','jurusan_id','harga'
    ];
}
