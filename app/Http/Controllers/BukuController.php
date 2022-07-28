<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Buku;
use App\Models\Jenis;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('jenis')->get();
        return response()->json($bukus);
    }
    public function detail($buku)
    {
        $data = Buku::where('id', $buku)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function destroy($buku)
    {
        $data = Buku::where('id', $buku)->first();
        if (empty($data)) {
            return response()->json(['message' => 'Data Tidak Ditemukan'], 404);
        }
        $data->delete();
        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 200); 
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'jenis' => 'required',
            'tahun_terbit' => 'required'
        ]);
        if ($validate->passes()) {
            return Buku::create($request->all());
        }
        
        return response()->json(['message' => 'Data Gagal Disimpan', 'pesan_error' => $validate->failed()]);
    }
    public function update(Request $request, $buku)
    {
        $data = Buku::where('id', $buku)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(),[
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'jenis' => 'required',
                'tahun_terbit' => 'required'
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
}
