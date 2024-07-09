<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiodataController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input data
        $request->validate([
            'name' => 'required|string',
            'fullname' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|integer',
            'anak' => 'required|integer',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk foto
            // Sesuaikan validasi untuk 'pendidikan_ids' dan 'skills_ids' sesuai kebutuhan
        ]);

        // Ambil input dari request
        $dataInput = [
            'name' => $request->input('name'),
            'fullname' => $request->input('fullname'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'umur' => $request->input('umur'),
            'anak' => $request->input('anak'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            // Tambahkan pemrosesan untuk 'pendidikan_ids' dan 'skills_ids' jika diperlukan
        ];

        // Proses menyimpan foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads'), $fotoName);
            $dataInput['foto'] = $fotoName;
        }

        // Buat biodata baru menggunakan metode create()
        $biodata = Biodata::create($dataInput);

        if ($biodata) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil terbuat',
                'data' => $biodata // Optional: Mengembalikan data yang baru saja dibuat
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal terbuat'
            ]);
        }
    }
    public function update(Request $request) {
        if (!$request->input('id')){
            return 'id required ';
        }
        $biodata = Biodata::where('id', $request->input('id')) ->first();
        if(!$biodata){
            return response()->json(['message' => 'biodata not found'],404);
        }
        $data = $request->all();
        $biodata->fill($data);
        $biodata->save();

        return response()->json(['mesaage' => 'user id' . $biodata->id . 'update'],200);
    }
    public function get(Request $request) {
        $id = $request->input('id');
        $biodata = Biodata::select('*');
        if ($id) {
            $biodata->where('id', $request->input('id'));
        }
        $getbio = $biodata->get();
        return $getbio;
    }
}
