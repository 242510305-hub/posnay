<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        if ($keyword) {
            $users = User::where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            })
                ->paginate(10)
                ->withQueryString();
        } else {
            $users = User::query()
                ->paginate(10)
                ->withQueryString();
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function edit(user $user)
    {
        // menerima data user yang akan di edit
        $roles = Role::all(); // mengambil semua data role

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $dataReq = $request->validated(); // validasi data dari form input

        $user->name = $dataReq['name'];
        $user->email = $dataReq['email'];
        $user->role_id = $dataReq['role_id'];

        // jika password diisi maka update password
        if (!empty($dataReq['password'])) {
            $user->password = Hash::make($dataReq['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User updated');
    }
    /**
     * Remove the specified resource from storage
     */
    public function destroy(User $user)
    {
        // Cek apakah user masih memiliki transaksi
        $jumlahPenjualan = \App\Models\Penjualan::where('user_id', $user->id)->count();

        if ($jumlahPenjualan > 0) {
            return redirect()
                ->route('admin.users')
                ->with(
                    'error',
                    'User tidak dapat dihapus karena masih memiliki ' .
                    $jumlahPenjualan .
                    ' transaksi penjualan.'
                );
        }

        // Jangan izinkan menghapus akun yang sedang login
        if (auth()->id() == $user->id) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dihapus.');
    }
}
