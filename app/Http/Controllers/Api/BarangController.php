<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\History;
use App\Barang;

class BarangController extends Controller
{
    public static $table;
    public static $log;

    public function __construct(Barang $barang, History $history)
    { 
        self::$table = $barang;
        self::$log   = $history;
    }
    public function index()
    {
        $res['code']    = 200;
        $res['message']  = 'ok'; 
        $res['data']  = self::$table->with('ruangan')->get();
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $data = [
            'nama_barang'            => $request->nama_barang,
            'desc'                   => $request->desc,
            'status'                 => $request->status,
            'status_keterangan'      => $request->status_keterangan,
            'total'                  => $request->total,
            'tgl_masuk'              => $request->tgl_masuk,
            'barcode'                => $request->barcode,
            'kategori_id'            => $request->kategori_id,
            'jurusan_id'             => $request->jurusan_id,
            'harga'                  => $request->harga,
        ];

        $validasi = \Validator::make($data,[
            'nama_barang'       => 'required|max:30|min:3',
            'desc'              => 'required|max:500|min:5',
            'status'            => 'required|numeric',
            'status_keterangan' => '',
            'total'             => 'required|numeric',
            'tgl_masuk'     => 'required',
            'barcode'           => 'required|numeric',
            'kategori_id'       => 'required|numeric',
            'jurusan_id'        => 'required|numeric',
            'harga'             => 'required|numeric'
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(), 400);

        }
        $store = self::$table->create($data);
        
        if($store)
        {
            self::$log->create([
               'message'  => 'memasukan barang baru',
               'desc'     => json_encode($data),
               'user_id'  => 1
            ]); 

            $res['code']        = 201;
            $res['message']     = 'success';
        }
        else{
            $res['code']        = 500;
            $res['message']     = 'failed';
        }

        return $res;
    }

    public function show(Request $request)
    {
        $data = self::$table->find($request->id);
        if(!count($data))
        {
            return response('Not Found', 404);
        }

        $res['code'] = 200;
        $res['message'] = 'success';
        $res['data']  = $data;

        return $res;
    }

    public function update(Request $request)
    {
        $from_db = self::$table->find($request->id);
        if(!count($from_db))
        {
            return response('Not Found', 404);
        }

       $data = [
            'nama_barang'            => $request->nama_barang,
            'desc'                   => $request->desc,
            'status'                 => $request->status,
            'status_keterangan'      => $request->status_keterangan,
            'total'                  => $request->total,
            'tgl_masuk'              => $request->tgl_masuk,
            'barcode'                => $request->barcode,
            'kategori_id'            => $request->kategori_id,
            'jurusan_id'             => $request->jurusan_id,
            'harga'                  => $request->harga,
        ];

        $validasi = \Validator::make($data,[
            'nama_barang'       => 'required|max:30|min:3',
            'desc'              => 'required|max:500|min:5',
            'status'            => 'required|numeric',
            'status_keterangan' => '',
            'total'             => 'required|numeric',
            'tgl_masuk'     => 'required',
            'barcode'           => 'required|numeric',
            'kategori_id'       => 'required|numeric',
            'jurusan_id'        => 'required|numeric',
            'harga'             => 'required|numeric'
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(),400);
        }

        $old    = $from_db;
        $update = $from_db->update($data);

        if($update)
        {
            $toLog = [
                'old' => $old,
                'new' => $data
            ];

            self::$log->create([
               'message'  => 'update barang',
               'desc'     => json_encode($toLog),
               'user_id'  => 1
            ]); 

            $res['code'] = 201;
            $res['message'] = 'updated success';
        }
        else{
            $res['code'] = 400;
            $res['message'] = 'update failed';
        }

        return $res;
    }

    public function delete(Request $request)
    {
        $from_db = self::$table->find($request->id);
        if(!count($from_db))
        {
            return response('Not Found', 404);
        }

        $from_db->delete();

        $old = $from_db;
        self::$log->create([
               'message'  => 'hapus barang',
               'desc'     => json_encode($from_db),
               'user_id'  => 1
        ]); 

        $res['code'] = 201;
        $res['message'] = 'deleted successfuly';

        return $res;
    }
}
