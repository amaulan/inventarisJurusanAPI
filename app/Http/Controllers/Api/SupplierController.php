<?php

namespace App\Http\Controllers\Api;

use App\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public static $table;

    public function __construct(Supplier $supplier)
    { 
        self::$table = $supplier;
    }
    
    public function index()
    {
        $res['code']    = 200;
        $res['message']  = 'ok'; 
        $res['data']  = self::$table->all();
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $data = [
            'supplier_name' => $request->supplier_name,
            'keterangan'         => $request->keterangan
        ];

        $validasi = \Validator::make($data,[
            'supplier_name'      => 'required|min:4|max:50|unique:supplier,supplier_name',
            'keterangan'         => 'required|min:1|max:200'   
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(), 400);

        }

        $store = self::$table->create($data);

        if($store)
        {
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
            'supplier_name' => $request->supplier_name,
            'keterangan'         => $request->keterangan
        ];

        $validasi = \Validator::make($data,[
            'supplier_name' => 'required|min:4|max:50|unique:supplier,supplier_name',
            'keterangan'         => 'required|min:1|max:200'   
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(),400);
        }

        $from_db->update($data);

        $res['code'] = 201;
        $res['message'] = 'updated success';

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

        $res['code'] = 201;
        $res['message'] = 'deleted successfuly';

        return $res;
    }
}
