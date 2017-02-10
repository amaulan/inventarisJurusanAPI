<?php

namespace App\Http\Controllers\Api;

use App\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $res['code']    = 200;
        $res['message']  = 'ok'; 
        $res['data']  = Kategori::all();
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $data = [
            'kategori_name' => $request->kategori_name,
            'desc'          => $request->desc
        ];

        $validasi = \Validator::make($data,[
            'kategori_name' => 'required|min:4|max:50|unique:kategori,kategori_name',
            'desc'          => 'required|min:1|max:200'
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(), 400);

        }

        $store = Kategori::create($data);

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
        $kategori = Kategori::find($request->id);
        if(!count($kategori))
        {
            return response('Not Found', 404);
        }

        $res['code'] = 200;
        $res['message'] = 'success';
        $res['data']  = $kategori;

        return $res;
    }

    public function update(Request $request)
    {
        $kategori = Kategori::find($request->id);
        if(!count($kategori))
        {
            return response('Not Found', 404);
        }

        $data = [
            'kategori_name' => $request->kategori_name,
            'desc'          => $request->desc
        ];

        $validasi = \Validator::make($data,[
            'kategori_name' => 'required|min:4|max:50|unique:kategori,kategori_name',
            'desc'          => 'required|min:1|max:200'
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(),400);
        }

        $kategori->update($data);

        $res['code'] = 201;
        $res['message'] = 'updated success';

        return $res;
    }

    public function delete(Request $request)
    {
        $kategori = Kategori::find($request->id);
        if(!count($kategori))
        {
            return response('Not Found', 404);
        }

        $kategori->delete();

        $res['code'] = 201;
        $res['message'] = 'deleted successfuly';

        return $res;
    }
}
