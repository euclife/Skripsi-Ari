<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    public function index(Request $request){
        $perusahaan = Perusahaan::all();
        return response()->json([
            "status" => 200,
            "message" => "success",
            "data" => $perusahaan
        ], 200);
    }

    public function store(Request $request){

        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'nomor_fax' => 'nullable',
            'website' => 'nullable|url',
            'provinsi' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
        ]);

        $perusahaan = new Perusahaan();
        $perusahaan->nama = $request->nama;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->nomor_telepon = $request->nomor_telepon;
        $perusahaan->nomor_fax = $request->nomor_telepon;
        $perusahaan->website = $request->website;
        $perusahaan->provinsi = $request->provinsi;
        $perusahaan->kota = $request->kota;
        $perusahaan->kode_pos = $request->kode_pos;
        $perusahaan->created_by = Auth::id();
        $perusahaan->save();

        return response()->json([
            "status" => 200,
            "message" => "success",
            "data" => $perusahaan
        ], 200);
    }
}
