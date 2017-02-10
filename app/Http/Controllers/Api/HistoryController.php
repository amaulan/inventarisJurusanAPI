<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\History;

class HistoryController extends Controller
{
    public static $table;

    public function __construct(History $history)
    { 
        self::$table = $history;
    }
    
    public function index()
    {
        $res['code']     = 200;
        $res['message']  = 'ok'; 
        $res['data']     = self::$table->all();
        return response()->json($res);
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

}
