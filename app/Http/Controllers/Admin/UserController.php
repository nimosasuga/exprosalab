<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua data user, diurutkan dari yang terbaru, dan dibatasi 10 per halaman
        $users = User::latest()->paginate(10);

        return view('admin.users', compact('users'));
    }
}
