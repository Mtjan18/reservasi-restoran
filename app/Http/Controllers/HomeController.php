<?php

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (landing page) untuk pelanggan.
     */
    public function index()
    {
        // View 'welcome' adalah view default Laravel, kita akan ubah kontennya di langkah berikutnya.
        return view('welcome');
    }
}