<?php

namespace App\Http\Controllers\Api;

use App\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuanganController extends Controller
{
        public function index()
    {
        $res['code']    = 200;
        $res['message']  = 'ok'; 
        $res['data']  = Ruangan::all();
        // return response(200)->json($data);
        // return response(200)->json($data);
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $data = [
            'ruangan_nama' => $request->ruangan_nama,
            'desc'         => $request->desc
        ];

        $validasi = \Validator::make($data,[
            'ruangan_nama' => 'required|min:4|max:50|unique:ruangan,ruangan_nama',
            'desc'         => 'required|min:1|max:200'   
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(), 400);

        }

        $store = Ruangan::create($data);

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
        $data = Ruangan::find($request->id);
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
        $from_db = Ruangan::find($request->id);
        if(!count($from_db))
        {
            return response('Not Found', 404);
        }

        $data = [
            'ruangan_nama' => $request->ruangan_nama,
            'desc'         => $request->desc
        ];

        $validasi = \Validator::make($data,[
            'ruangan_nama' => 'required|min:4|max:50|unique:ruangan,ruangan_nama',
            'desc'         => 'required|min:1|max:200'   
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
        $from_db = Ruangan::find($request->id);
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
