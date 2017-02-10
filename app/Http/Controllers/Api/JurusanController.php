<?php

namespace App\Http\Controllers\Api;

use App\Jurusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JurusanController extends Controller
{
    public function index()
    {
        $res['code']    = 200;
        $res['message']  = 'ok'; 
        $res['data']  = Jurusan::all();
        // return response(200)->json($data);
        // return response(200)->json($data);
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $data = [
            'jurusan_name' => $request->jurusan_name
        ];

        $validasi = \Validator::make($data,[
            'jurusan_name' => 'required|min:4|max:50|unique:jurusan,jurusan_name'
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(), 400);

        }

        $store = Jurusan::create($data);

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
        $jurusan = Jurusan::find($request->id);
        if(!count($jurusan))
        {
            return response('Not Found', 404);
        }

        $res['code'] = 200;
        $res['message'] = 'success';
        $res['data']  = $jurusan;

        return $res;
    }

    public function update(Request $request)
    {
        $jurusan = Jurusan::find($request->id);
        if(!count($jurusan))
        {
            return response('Not Found', 404);
        }

        $data = [
            'jurusan_name' => $request->jurusan_name
        ];

        $validasi = \Validator::make($data,[
            'jurusan_name' => 'required|min:4|max:50|unique:jurusan,jurusan_name'
        ]);

        if($validasi->fails())
        {
            return response($validasi->errors()->all(),400);
        }

        $jurusan->update($data);

        $res['code'] = 201;
        $res['message'] = 'updated success';

        return $res;
    }

    public function delete(Request $request)
    {
        // return 1;
        $jurusan = Jurusan::find($request->id);
        if(!count($jurusan))
        {
            return response('Not Found', 404);
        }

        $jurusan->delete();

        $res['code'] = 201;
        $res['message'] = 'deleted successfuly';

        return $res;
    }
}
