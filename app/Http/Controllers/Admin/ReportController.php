<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman Laporan Reservasi dan memproses filter.
     * Corresponds to: Laporan Reservasi (Harian/Mingguan/Bulanan) di WBS.
     */
    public function index(Request $request)
    {
        // Mendefinisikan rentang waktu default (misal: 7 hari terakhir)
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika tidak ada input tanggal, gunakan rentang 7 hari terakhir
        if (!$startDate || !$endDate) {
            $endDate = Carbon::today()->toDateString();
            $startDate = Carbon::today()->subDays(6)->toDateString(); // 7 hari termasuk hari ini
        }
        
        // Pastikan tanggal diformat untuk query
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();
        
        // Ambil data reservasi dalam rentang waktu tersebut
        $reservations = Reservation::with(['customer', 'payment', 'assignedTables.table'])
                        ->whereBetween('date', [$startDate, $endDate])
                        ->orderBy('date', 'asc')
                        ->orderBy('time', 'asc')
                        ->get();

        // Menghitung Ringkasan Statistik
        $summary = [
            'total_reservations' => $reservations->count(),
            'total_guests' => $reservations->sum('numOfPeople'),
            'confirmed_count' => $reservations->where('status', 'confirmed')->count(),
            'cancelled_count' => $reservations->where('status', 'cancel')->count(),
            'total_paid' => $reservations->filter(function ($r) {
                return optional($r->payment)->status === 'paid';
            })->count(),
        ];
        
        return view('admin.reports.index', compact('reservations', 'summary', 'startDate', 'endDate'));
    }
}