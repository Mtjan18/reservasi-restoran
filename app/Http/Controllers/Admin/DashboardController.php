<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\TableList;
use Carbon\Carbon; // Untuk membandingkan tanggal

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama admin dengan statistik reservasi hari ini.
     * Corresponds to: Dashboard monitoring reservasi di WBS.
     */
    public function index()
    {
        // Mendapatkan tanggal hari ini
        $today = Carbon::today()->toDateString();
        
        // 1. Statistik Reservasi Hari Ini
        $reservationsToday = Reservation::where('date', $today)
            ->with(['customer', 'assignedTables.table'])
            ->get();
            
        $totalReservationsToday = $reservationsToday->count();
        $confirmedReservations = $reservationsToday->where('status', 'confirmed')->count();
        $pendingReservations = $reservationsToday->where('status', 'pending')->count();
        
        // 2. Statistik Meja
        $totalTables = TableList::count();
        $availableTables = TableList::where('status', 'available')->count();
        
        // Data yang dikirim ke view
        $data = [
            'reservationsToday' => $reservationsToday,
            'stats' => [
                'totalReservationsToday' => $totalReservationsToday,
                'confirmedReservations' => $confirmedReservations,
                'pendingReservations' => $pendingReservations,
                'totalTables' => $totalTables,
                'availableTables' => $availableTables,
            ]
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Menampilkan daftar lengkap reservasi yang akan datang (future reservations).
     * Corresponds to: Melihat Daftar Reservasi & Laporan Reservasi di Activity Diagram.
     */
    public function reservationsList(Request $request)
    {
        $query = Reservation::with(['customer', 'payment', 'assignedTables.table'])
                    ->where('date', '>=', Carbon::today()->toDateString()) // Hanya yang akan datang atau hari ini
                    ->orderBy('date', 'asc')
                    ->orderBy('time', 'asc');
        
        // Filter status (jika ada)
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $reservations = $query->get();

        return view('admin.reservations.list', compact('reservations'));
    }
}