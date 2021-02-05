<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\FileNotaBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $page_title = 'Barang';
        $page_description = 'Halaman Tambah Data Barang';
        if (request()->ajax()) {
            $datas = Barang::with('kontrak', 'creator','updater','nota');
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('edit', function ($data) {
                    return route("Barang.edit", $data->id);
                })
                ->addColumn('show', function ($data) {
                    return route("Barang.show", $data->id);
                })
                ->addColumn('delete', function ($data) {
                    return route("Barang.destroy", $data->id);
                })
                ->make(true);
        }

        return view('pages.barang.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $page_title = 'Barang - Tambah';
        $page_description = 'Tambah Data Barang';

        return view('pages.barang.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'nama_perusahaan' => 'required',
            'nama_satuan' => 'required',
            'harga_satuan' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            'nota_pembelian' => "file|mimes:jpg,jpeg,bmp,png,pdf",
        ]);

        $barang = new Barang();
        $barang->nama = $request->nama_barang;
        $barang->id_kontrak = $request->nama_perusahaan;
        $barang->satuan = $request->nama_satuan;
        $barang->harga = $request->harga_satuan;
        $barang->jumlah = $request->jumlah_barang;
        $barang->created_by = Auth::id();
        $barang->save();

        $invoice = new FileNotaBarang();
        $invoice->id_barang = $barang->id;
        $invoice->original_name = $request->file('nota_pembelian')->getClientOriginalName();
        $invoice->file_name = "NOTA-" . Uuid::uuid4() . "-" . time() . "." . $request->file('nota_pembelian')->getClientOriginalExtension();
        $invoice->created_by = Auth::id();
        $request->nota_pembelian->move(public_path('uploads/nota'), $invoice->file_name);
        $invoice->save();

        return response()->json([
            "status" => 200,
            "message" => "success",
            "redirect" => route("Barang.index"),
            "data" => $barang
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function show(Request $request, $id)
    {
        $page_title = 'Barang - Detail Barang';
        $page_description = 'Detail Barang';
        $barang = Barang::findOrFail($id);

        return view('pages.barang.detail', compact('page_title', 'page_description','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function edit(Request $request, $id)
    {
        $page_title = 'Barang - Edit Barang';
        $page_description = 'Edit Barang';
        $barang = Barang::findOrFail($id);

        return view('pages.barang.edit', compact('page_title', 'page_description','barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'uuid|required',
            'nama_barang' => 'required',
            'nama_perusahaan' => 'required',
            'nama_satuan' => 'required',
            'harga_satuan' => 'required',
            'jumlah_barang' => 'required|numeric|min:1',
            'nota_pembelian' => "file|mimes:jpg,jpeg,bmp,png,pdf",
        ]);

        $barang = Barang::findOrFail($request->id);
        $barang->nama = $request->nama_barang;
        $barang->id_kontrak = $request->nama_perusahaan;
        $barang->satuan = $request->nama_satuan;
        $barang->harga = $request->harga_satuan;
        $barang->jumlah = $request->jumlah_barang;
        $barang->updated_by = Auth::id();
        $barang->save();

        if ($request->hasFile('nota_pembelian')) {
            $invoiceTemp = FileNotaBarang::where("id_barang", $barang->id)->first();
            $invoiceTemp->destroy();

            $invoice = new FileNotaBarang();
            $invoice->id_barang = $barang->id;
            $invoice->original_name = $request->file('nota_pembelian')->getClientOriginalName();
            $invoice->file_name = "NOTA-" . Uuid::uuid4() . "-" . time() . "." . $request->file('nota_pembelian')->getClientOriginalExtension();
            $invoice->created_by = Auth::id();
            $request->nota_pembelian->move(public_path('uploads/nota'), $invoice->file_name);
            $invoice->save();
        }

        return response()->json([
            "status" => 200,
            "message" => "success",
            "redirect" => route("Barang.index"),
            "data" => $barang
        ], 200);
    }
}
