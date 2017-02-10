<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Supplier;
use App\Barang;
use App\History;

class SupplierBarang extends Controller
{
    public static $table;
    public static $log;

    public function __construct(Supplier $supplier, History $history)
    { 
        self::$table = $supplier;
        self::$log   = $history;
    }
    public function index()
    {
        $res['code']    = 200;
        $res['message']  = 'ok'; 
        $res['data']  = self::$table->with('barang')->get();
        return response()->json($res);
    }

   public function show(Request $request)
    {
        $data = self::$table->with('barang')->where('id','=',$request->id)->get();
        if(!count($data))
        {
            return response('Not Found', 404);
        }

        $res['code'] = 200;
        $res['message'] = 'success';
        $res['data']  = $data;

        return $res;
    }
}
