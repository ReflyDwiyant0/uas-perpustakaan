<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Jenis;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenis::all();
        return response()->json($jenis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nama' => 'required'
        ]);
        var_dump($validate->passes());
        if ($validate->passes()) {
            return Jenis::create($request->all());
        }
        
        return response()->json(['message' => 'Data Gagal Disimpan', 'pesan error' => $validate->failed()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show($jenis)
    {
        $data = Jenis::where('id', $jenis)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jenis)
    {
        $data = Jenis::where('id', $jenis)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(),[
                'nama' => 'required',
                'deskripsi' => 'required'
            ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Berhasil Disimpan',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data Gagal Disimpan'
                ]);
            }
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy($jenis)
    {
        $data = Jenis::where('id', $jenis)->first();
        if (empty($data)) {
            return response()->json(['message' => 'Data Tidak Ditemukan'], 404);
        }
        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 200);
    }
}
