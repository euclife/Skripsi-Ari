<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            $data = Kontrak::with('perusahaan');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tgl_serah_terima', function ($data) {
                    return Carbon::createFromFormat('d/m/Y',$data->tanggal_serah_terima);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|confirmed',
            'status' => 'required|string',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
