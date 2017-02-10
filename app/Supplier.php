<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $fillable = [
        'supplier_name',
        'keterangan'
    ];

    public function barang()
    {
        return $this->belongsToMany(
            Barang::class,
            'supplier_barang',
            'supplier_id',
            'barang_id'
        );
    }
}
