<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangController extends Controller
{
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
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|confirmed',
            'status' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->save();

        return response()->json([
            "status" => 200,
            "message" => "success",
            "redirect" => route("Account.index"),
            "data" => $user
        ], 200);
    }
}
