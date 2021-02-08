<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailPengiriman;
use App\Models\FileKontrakInvoice;
use App\Models\FileKontrakPerjanjian;
use App\Models\Kontrak;
use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $page_title = 'Kontrak';
        $page_description = 'Halaman Kontrak';

        if (request()->ajax()) {
            $datas = Kontrak::with('perusahaan');
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('tgl_serah_terima', function ($data) {
                    return Carbon::parse($data->tanggal_serah_terima_barang)->format("'d/m/Y'");
                })->addColumn('edit', function ($data) {
                    return route("Kontrak.edit", $data->id);
                })
                ->addColumn('show', function ($data) {
                    return route("Kontrak.show", $data->id);
                })
                ->addColumn('delete', function ($data) {
                    return route("Kontrak.destroy", $data->id);
                })
                ->make(true);
        }

        return view('pages.kontrak.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $page_title = 'Tambah Kontrak';
        $page_description = 'Tambah Kontrak';

        return view('pages.kontrak.create', compact('page_title', 'page_description'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'perusahaan' => 'required|max:255',
            'keterangan' => 'nullable|string',
            'tentang' => 'required|max:255',
            'nomor' => 'required',
            'tanggal_surat_pesanan' => 'required',
            'tanggal_serah_terima' => 'required',
            'file_dokumen_perjanjian' => 'required|file|mimes:jpg,jpeg,bmp,png,pdf',
            'file_dokumen_invoice' => 'required|file|mimes:jpg,jpeg,bmp,png,pdf',
            'barang.*.nama_barang' => 'required',
            'barang.*.jumlah_barang' => 'required',
            'barang.*.satuan' => 'required',
            'barang.*.harga_satuan' => 'required',
        ]);

        $kontrak = new Kontrak();
        $kontrak->id_perusahaan = $request->perusahaan;
        $kontrak->nomor = $request->nomor;
        $kontrak->tentang = $request->tentang;
        $kontrak->tanggal_surat_pesanan = Carbon::parse($request->tanggal_surat_pesanan);
        $kontrak->tanggal_serah_terima_barang = Carbon::parse($request->tanggal_serah_terima);
        $kontrak->status = "Dalam Pengerjaan";
        $kontrak->keterangan = $request->keterangan;
        $kontrak->created_by = Auth::id();
        $kontrak->save();

        foreach ($request->barang as $barangData) {
            $barang = new Barang();
            $barang->id_kontrak = $kontrak->id;
            $barang->nama = $barangData['nama_barang'];
            $barang->satuan = $barangData['satuan'];
            $barang->jumlah = $barangData['jumlah_barang'];
            $barang->harga = $barangData['harga_satuan'];
            $barang->created_by = Auth::id();
            $barang->save();
        }

        $invoice = new FileKontrakInvoice();
        $invoice->id_kontrak = $kontrak->id;
        $invoice->original_name = $request->file('file_dokumen_invoice')->getClientOriginalName();
        $invoice->file_name = "INVOICE-" . Uuid::uuid4() . "-" . time() . "." . $request->file('file_dokumen_invoice')->getClientOriginalExtension();
        $invoice->created_by = Auth::id();
        $request->file_dokumen_invoice->move(public_path('uploads/invoices'), $invoice->file_name);
        $invoice->save();

        $perjanjian = new FileKontrakPerjanjian();
        $perjanjian->id_kontrak = $kontrak->id;
        $perjanjian->original_name = $request->file('file_dokumen_perjanjian')->getClientOriginalName();
        $perjanjian->file_name = "PERJANJIAN-" . Uuid::uuid4() . "-" . time() . "." . $request->file('file_dokumen_perjanjian')->getClientOriginalExtension();
        $perjanjian->created_by = Auth::id();
        $request->file_dokumen_perjanjian->move(public_path('uploads/perjanjian'), $perjanjian->file_name);
        $perjanjian->save();

        return response()->json([
            "status" => 200,
            "message" => "success",
            "redirect" => route("Kontrak.index"),
            "data" => $kontrak
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = 'Detail Kontrak';
        $page_description = 'Detail Kontrak';

        if (request()->ajax()) {
            $kontrak = Kontrak::with(["perusahaan", "barang"])->findOrFail($id);
            $barang = [];
            foreach ($kontrak->barang as $key => $value) {
                $barang[$key]["id"] = $value->id;
                $barang[$key]["nama"] = $value->nama;
                $barang[$key]["satuan"] = $value->satuan;
                $barang[$key]["jumlah"] = $value->jumlah;
                $barang[$key]["harga"] = $value->harga;
                $barang[$key]["dikirim"] = 0;
            }

            $pengiriman = Pengiriman::where("id_kontrak", $kontrak->id)->get();
            foreach ($pengiriman as $item) {
                $detailPengiriman = DetailPengiriman::where("id_pengiriman", $item->id)->get();
                foreach ($detailPengiriman as $pengirim) {
                    foreach ($barang as $key => $value) {
                        if ($value["id"] == $pengirim->id_barang) {
                            $barang[$key]["dikirim"] += $pengirim->jumlah_kirim;
                            break;
                        }
                    }
                }
            }

            return response()->json([
                "status" => 200,
                "message" => "success",
                "data" => [
                    "kontrak" => $kontrak,
                    "barang" => $barang
                ]
            ]);
        }

        $kontrak = Kontrak::findOrFail($id);

        return view('pages.kontrak.detail', compact('page_title', 'page_description', "kontrak"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit Kontrak';
        $page_description = 'Edit Kontrak';
        $kontrak = Kontrak::findOrFail($id);

        return view('pages.kontrak.edit', compact('page_title', 'page_description', 'kontrak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $kontrak = Kontrak::findOrFail($id);
        $request->validate([
            'id' => 'required|uuid',
            'perusahaan' => 'required|max:255',
            'keterangan' => 'nullable|string',
            'tentang' => 'required|max:255',
            'nomor' => 'required',
            'tanggal_surat_pesanan' => 'required',
            'tanggal_serah_terima' => 'required',
            'file_dokumen_perjanjian' => 'file|mimes:jpg,jpeg,bmp,png,pdf',
            'file_dokumen_invoice' => 'file|mimes:jpg,jpeg,bmp,png,pdf',
            'barang.*.id' => 'nullable|uuid',
            'barang.*.nama_barang' => 'required',
            'barang.*.jumlah_barang' => 'required',
            'barang.*.satuan' => 'required',
            'barang.*.harga_satuan' => 'required',
        ]);

        $kontrak->id_perusahaan = $request->perusahaan;
        $kontrak->nomor = $request->nomor;
        $kontrak->tentang = $request->tentang;
        $kontrak->tanggal_surat_pesanan = Carbon::parse($request->tanggal_surat_pesanan);
        $kontrak->tanggal_serah_terima_barang = Carbon::parse($request->tanggal_serah_terima);
        $kontrak->keterangan = $request->keterangan;
        $kontrak->updated_by = Auth::id();
        $kontrak->save();

        $dataBarang = Barang::where("id_kontrak", $kontrak->id)->get();
        foreach ($dataBarang as $data) {
            $status = false;
            foreach ($request->barang as $barangData) {
                if (isset($barangData['id'])) {
                    if ($barangData['id'] == $data->id) {
                        $status = true;
                        break;
                    }
                }
            }
            if (!$status) Barang::destroy($id);
        }

        foreach ($request->barang as $barangData) {
            if (isset($barangData['id'])) {
                $barang = Barang::find($barangData["id"]);
                $barang->nama = $barangData['nama_barang'];
                $barang->satuan = $barangData['satuan'];
                $barang->jumlah = $barangData['jumlah_barang'];
                $barang->harga = $barangData['harga_satuan'];
                $barang->updated_by = Auth::id();
                $barang->save();
            } else {
                $barang = new Barang();
                $barang->id_kontrak = $kontrak->id;
                $barang->nama = $barangData['nama_barang'];
                $barang->satuan = $barangData['satuan'];
                $barang->jumlah = $barangData['jumlah_barang'];
                $barang->harga = $barangData['harga_satuan'];
                $barang->updated_by = Auth::id();
                $barang->save();
            }
        }

        if ($request->hasFile('file_dokumen_invoice')) {
            $invoiceTemp = FileKontrakInvoice::where("id_kontrak", $kontrak->id)->first();
            $invoiceTemp->destroy();

            $invoice = new FileKontrakInvoice();
            $invoice->id_kontrak = $kontrak->id;
            $invoice->original_name = $request->file('file_dokumen_invoice')->getClientOriginalName();
            $invoice->file_name = "INVOICE-" . Uuid::uuid4() . "-" . time() . "." . $request->file('file_dokumen_invoice')->getClientOriginalExtension();
            $invoice->created_by = Auth::id();
            $request->file_dokumen_invoice->move(public_path('uploads/invoices'), $invoice->file_name);
            $invoice->save();
        }

        if ($request->hasFile('file_dokumen_perjanjian')) {
            $invoiceTemp = FileKontrakPerjanjian::where("id_kontrak", $kontrak->id)->first();
            $invoiceTemp->destroy();

            $perjanjian = new FileKontrakPerjanjian();
            $perjanjian->id_kontrak = $kontrak->id;
            $perjanjian->original_name = $request->file('file_dokumen_perjanjian')->getClientOriginalName();
            $perjanjian->file_name = "PERJANJIAN-" . Uuid::uuid4() . "-" . time() . "." . $request->file('file_dokumen_perjanjian')->getClientOriginalExtension();
            $perjanjian->created_by = Auth::id();
            $request->file_dokumen_perjanjian->move(public_path('uploads/perjanjian'), $perjanjian->file_name);
            $perjanjian->save();
        }

        return response()->json([
            "status" => 200,
            "message" => "success",
            "redirect" => route("Kontrak.index"),
            "data" => $kontrak
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setStatusKontrak($id_kontrak)
    {
        $kontrak = Kontrak::find($id_kontrak);
        if ($kontrak) {
            if ($kontrak->total_dikirim()->sum("pengiriman.jumlah") >= $kontrak->barang()->sum("jumlah")) {
                $kontrak->status = "SELESAI";
                $kontrak->save();
            }
        }
    }
}
