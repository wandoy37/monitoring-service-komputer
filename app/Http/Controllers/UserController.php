<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users');
        // Mencari data berdasarkan nilai search
        if (request('search')) {
            $users->where('name', 'LIKE', '%' . request('search') . '%');
        }
        // Mencari data berdasarkan nilai role
        if (request('role')) {
            $users->where('role', 'LIKE', '%' . request('role') . '%');
        }

        // Jika terdapat nilai search
        $search = request('search') ?? '';
        // Jika terdapat nilai role
        $role = request('role') ?? '';

        // tampilkan data users
        $users = $users->get();
        // roles
        $roles = $this->roles();

        return view('admin.user.index', compact('users', 'search', 'roles', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roles();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:6',
                'role' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Jika berhasil melewati valdator maka tangkap data dan kirim ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect('/admin/user')->with('success', 'Berhasil menambahkan ' . $request->name . ' sebagai pengguna baru');
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
        $user = User::find($id);
        $roles = $this->roles();
        return view('admin.user.edit', compact('user', 'roles'));
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
        // Tangkap id berdasarkan parameter
        $user = User::find($id);

        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
            ],
            [],
        );

        // kondisi jika validasi gagal dilewati.
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Jika berhasil melewati valdator maka tangkap data dan kirim ke database
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika terdapat nilai pada password
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // return response()->json($data);
        // Update data user
        $user->update($data);
        return redirect('/admin/user')->with('success', 'Berhasil update pengguna ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
        return redirect('/admin/user')->with('success', 'Berhasil menghapus pengguna ' . $user->name);
    }

    private function roles()
    {
        return [
            'admin' => 'admin',
            'marketing' => 'marketing',
            'teknisi' => 'teknisi',
        ];
    }
}
