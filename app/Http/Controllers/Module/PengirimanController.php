<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\DetailPengiriman;
use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PengirimanController extends Controller
{
    private $kontrakController;
    public function __construct()
    {
        $this->kontrakController = new KontrakController();
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $page_title = 'Pengiriman';
        $page_description = 'List Pengiriman';

        if (request()->ajax()) {
            $datas = Pengiriman::with('kontrak.perusahaan');
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($data) {
                    return Carbon::parse($data->tanggal_pengiriman)->format("'d/m/Y'");
                })->addColumn('edit', function ($data) {
                    return route("Pengiriman.edit", $data->id);
                })
                ->addColumn('show', function ($data) {
                    return route("Pengiriman.show", $data->id);
                })
                ->addColumn('delete', function ($data) {
                    return route("Pengiriman.destroy", $data->id);
                })
                ->make(true);
        }

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
//            'dokumen' => 'required|file|mnimes:jpg,jpeg,bmp,png,pdf',
            'barang.*.id' => 'required|uuid',
            'barang.*.kirim' => 'nullable|integer',
        ]);

        $pengiriman = new Pengiriman();
        $pengiriman->id_kontrak = $request->perusahaan;
        $pengiriman->jumlah = $request->jumlah;
        $pengiriman->tanggal_pengiriman = $request->tanggal_pengiriman;
        $pengiriman->nama_penerima = $request->nama_penerima;
        $pengiriman->created_by = Auth::id();
        $pengiriman->save();

        foreach($request->barang as $key => $value){
            $dataKirim = 0;
            if($value['kirim']) {
                $dataKirim = $value['kirim'];
            }
            $barang = new DetailPengiriman();
            $barang->id_pengiriman = $pengiriman->id;
            $barang->id_barang = $value['id'];
            $barang->jumlah_kirim = $dataKirim;
            $barang->created_by = Auth::id();
            $barang->save();
        }

        $this->kontrakController->setStatusKontrak($pengiriman->id_kontrak);

        return response()->json([
            "status" => 200,
            "message" => "success",
            "redirect" => route("Pengiriman.index"),
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
        $pengiriman = Pengiriman::with('kontrak.perusahaan','detail_pengiriman.barang')->findOrFail($id);

        return view('pages.pengiriman.detail', compact('page_title', 'page_description','pengiriman'));
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
