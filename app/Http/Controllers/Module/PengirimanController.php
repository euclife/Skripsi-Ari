<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\DetailPengiriman;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $page_title = 'Pengiriman';
        $page_description = 'List Pengiriman';

        return view('pages.pengiriman.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $page_title = 'Pengiriman';
        $page_description = 'Buat Pengiriman';

        return view('pages.pengiriman.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'keterangan' => 'nullable|string',
            'tanggal_pengiriman' => 'required|max:255',
            'nama_penerima' => 'required',
            'dokumen' => 'required|file|mnimes:jpg,jpeg,bmp,png,pdf',
            'barang.*.id_barang' => 'required|uuid',
            'barang.*.jumlah' => 'required|integer',
        ]);

        $pengiriman = new Pengiriman();
        $pengiriman->jumlah = $request->pengiriman;
        $pengiriman->tanggal_pengiriman = $request->tanggal_pengiriman;
        $pengiriman->nama_penerima = $request->nama_penerima;
        $pengiriman->created_by = Auth::id();
        $pengiriman->save();

        foreach($request->barang as $key => $value){
            $barang = new DetailPengiriman();
            $barang->id_barang = $value->id_barang;
            $barang->jumlah_kirim = $value->jumlah_kirim;
            $barang->save();
        }

        return response()->json([
            "status" => 200,
            "message" => "success",
            "data" => $pengiriman
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = 'Pengiriman';
        $page_description = 'Buat Pengiriman';

        return view('pages.pengiriman.detail', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Pengiriman';
        $page_description = 'Edit Pengiriman';

        return view('pages.pengiriman.edit', compact('page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
