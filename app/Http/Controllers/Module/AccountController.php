<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $page_title = 'Account';
        $page_description = 'Halaman Account';

        if (request()->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($data) {
                    return route("Account.edit", $data->id);
                })
                ->addColumn('delete', function ($data) {
                    return route("Account.destroy", $data->id);
                })
                ->make(true);
        }

        return view('pages.account.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $page_title = 'Account - Create';
        $page_description = 'Halaman membuat akun';

        return view('pages.account.create', compact('page_title', 'page_description'));
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $page_title = 'Account - Create';
        $page_description = 'Halaman membuat akun';

        $user = User::findOrFail($id);

        return view('pages.account.edit', [
            "page_title" => $page_title,
            "page_description" => $page_description,
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'id' => 'required|uuid',
            'name' => 'required|max:255|string',
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'password' => 'confirmed',
            'status' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->save();

        return response()->json([
            "status" => 200,
            "message" => "success",
            "redirect" => route("Account.index"),
            "data" => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id != Auth::id()) {
            User::destroy($id);
            if (request()->ajax()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $user
                ], 200);
            }

            return redirect()->route("Account.index")->with([
                "success" => "Sukses menghapus akun " . $user->name()
            ]);
        }

        if (request()->ajax()) {
            if ($user->id != Auth::id()) {
                User::destroy($id);
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $user
                ], 200);
            }
            return response()->json([
                'status' => 405,
                'message' => 'Cannot Delete self account!',
            ], 404);
        }
    }
}
