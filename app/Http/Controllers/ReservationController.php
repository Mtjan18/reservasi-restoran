<?php

// app/Http/Controllers/ReservationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TableList;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\ReservationTable;
use App\Models\Notifications;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Menampilkan formulir interaktif untuk reservasi meja.
     * Corresponds to the 'Reservasi Meja Online' feature[cite: 23].
     */
    public function create()
    {
        return view('reservation.create');
    }

    /**
     * Memproses data form dan mengecek ketersediaan meja secara real-time.
     * Corresponds to the 'Pencarian Ketersediaan Real-time' requirement[cite: 16].
     */
    public function checkAvailability(Request $request)
    {
        // 1. Validasi Input Data
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'numOfPeople' => 'required|integer|min:1',
            'name' => 'required|string|max:100',
            'phoneNumber' => 'required|string|max:20',
            'email' => 'required|email|max:100',
        ]);

        // Data yang diinput pelanggan
        $data = $request->only(['date', 'time', 'numOfPeople', 'name', 'phoneNumber', 'email']);

        // --- Simulasi Logic Cek Ketersediaan (Akan diimplementasikan penuh saat model siap) ---

        // Di sini seharusnya ada logika kompleks untuk:
        // 1. Mencari semua meja (TableList) [cite: 52]
        // 2. Mengecek kapasitas meja yang lebih besar atau sama dengan $data['numOfPeople'][cite: 29].
        // 3. Mengecek tabel 'ReservationTable' dan 'Reservation' untuk jam dan tanggal yang bentrok.

        // Sementara ini, kita simulasikan ketersediaan.
        $availableTables = TableList::where('capacity', '>=', $data['numOfPeople'])
            // Misalnya, ambil 3 meja yang cocok sebagai contoh
            ->limit(3)
            ->get();

        if ($availableTables->isEmpty()) {
            // Tampilkan pesan/saran alternatif [cite: 45]
            return back()->with('error', 'Maaf, tidak ada meja yang tersedia untuk kriteria Anda pada waktu tersebut. Silakan coba waktu lain.');
        }

        // Jika tersedia, lanjutkan ke halaman konfirmasi
        // Kita simpan data reservasi sementara di session untuk digunakan di langkah konfirmasi
        session(['reservation_data' => $data]);
        session(['available_tables' => $availableTables]);

        return redirect()->route('reservation.confirmation');
    }

    /**
     * Method untuk menampilkan halaman pilihan meja dan konfirmasi akhir.
     */
    public function confirmation()
    {
        // Pastikan data reservasi ada di session
        if (!session('reservation_data') || !session('available_tables')) {
            return redirect()->route('reservation.create')->with('error', 'Silakan isi formulir reservasi terlebih dahulu.');
        }

        $data = session('reservation_data');
        $tables = session('available_tables');

        return view('reservation.confirmation', compact('data', 'tables'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Akhir
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'numOfPeople' => 'required|integer|min:1',
            'name' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|email',
            'tableId' => 'required|integer|exists:table_lists,tableId', // Pastikan meja yang dipilih valid
            'paymentMethod' => 'required|in:Transfer,QRIS,Cash',
        ]);

        try {
            // Memulai transaksi database (PENTING untuk menjaga integritas data)
            DB::beginTransaction();

            // 2. Cek/Buat Data Pelanggan (Customer)
            // Cek apakah user sudah ada berdasarkan email
            $user = \App\Models\User::where('email', $request->email)->first();
            
            if (!$user) {
                // Buat user baru jika belum ada
                $user = \App\Models\User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => \Illuminate\Support\Facades\Hash::make('temporary_password'),
                    'role' => 'customer',
                ]);
                
                // Buat customer baru
                $customer = Customer::create([
                    'userId' => $user->userId,
                    'phoneNumber' => $request->phoneNumber,
                ]);
            } else {
                // Ambil customer yang sudah ada
                $customer = Customer::where('userId', $user->userId)->first();
                
                // Update phone number jika berbeda
                if ($customer && $customer->phoneNumber !== $request->phoneNumber) {
                    $customer->update(['phoneNumber' => $request->phoneNumber]);
                }
            }

            // 3. Buat Booking Code Unik
            $bookingCode = Str::random(8); // Contoh kode booking 8 karakter

            // 4. Simpan Reservasi
            $reservation = Reservation::create([
                'date' => $request->date,
                'time' => $request->time,
                'numOfPeople' => $request->numOfPeople,
                'bookingCode' => $bookingCode,
                'status' => 'confirmed', // Langsung confirmed karena sudah bayar/pilih meja
                'customerId' => $customer->customerId,
            ]);

            // 5. Simpan Detail Meja yang Dipesan (Tabel ReservationTable)
            ReservationTable::create([
                'reservationId' => $reservation->reservationId,
                'tableId' => $request->tableId,
                'assignedAt' => now(),
            ]);

            // 6. Simpan Detail Pembayaran (Tabel Payment)
            Payment::create([
                'reservationId' => $reservation->reservationId,
                'amount' => 0, // Asumsi 0 jika Cash atau belum ada DP
                'method' => $request->paymentMethod,
                'status' => ($request->paymentMethod === 'Cash') ? 'unpaid' : 'paid', // Cash dibayar di tempat, lainnya dianggap dibayar
                'paymentDate' => ($request->paymentMethod === 'Cash') ? null : now(),
            ]);

            // 7. Kirim Notifikasi (Simpan di Tabel Notifications)
            Notifications::create([
                'reservationId' => $reservation->reservationId,
                'message' => 'Reservasi Anda telah berhasil dikonfirmasi dengan kode booking: ' . $bookingCode,
                'sentAt' => now(),
                'type' => 'email', // Sesuai requirement: email/SMS/aplikasi [cite: 19]
            ]);

            // 8. Commit Transaksi
            DB::commit();

            // Hapus data sementara dari session
            $request->session()->forget(['reservation_data', 'available_tables']);

            // 9. Redirect ke halaman sukses dengan kode booking
            return redirect()->route('reservation.success', ['code' => $bookingCode])
                ->with('success', 'Reservasi Anda Berhasil!')
                ->with('bookingCode', $bookingCode);
        } catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            // Tampilkan pesan error
            return back()->with('error', 'Terjadi kesalahan saat memproses reservasi: ' . $e->getMessage());
        }
    }

    public function checkForm()
    {
        return view('booking.check_form');
    }

    /**
     * Mencari dan menampilkan detail reservasi berdasarkan Kode Booking atau No. Telp.
     */
    public function checkResult(Request $request)
    {
        $request->validate([
            'bookingCode' => 'nullable|string|max:50',
            'phoneNumber' => 'nullable|string|max:20',
        ]);

        $code = strtoupper($request->bookingCode);
        $phone = $request->phoneNumber;

        if (empty($code) && empty($phone)) {
            return back()->with('error', 'Masukkan Kode Booking atau Nomor Telepon.');
        }

        // Logika kompleks untuk mencari reservasi
        $reservation = Reservation::where('bookingCode', $code)
            ->orWhereHas('customer', function ($query) use ($phone) {
                $query->where('phoneNumber', $phone);
            })
            // Tambahkan relasi yang diperlukan agar semua data terlihat (Customer, Table)
            ->with(['customer', 'assignedTables.table']) 
            ->first();

        if (!$reservation) {
            return back()->with('error', 'Reservasi tidak ditemukan. Cek kembali data yang Anda masukkan.');
        }

        // Arahkan ke halaman detail dengan data reservasi
        return view('booking.detail', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        // Pastikan reservasi belum dibatalkan dan belum kadaluarsa
        if ($reservation->status == 'cancel') {
            return back()->with('error', 'Reservasi ini sudah dibatalkan dan tidak bisa diubah.');
        }

        return view('booking.edit', compact('reservation'));
    }

    /**
     * Memproses perubahan reservasi dan memperbarui di database.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Validasi dan logika cek ketersediaan meja baru mirip seperti checkAvailability, 
        // namun juga harus melepaskan meja lama (jika ada perubahan).
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'numOfPeople' => 'required|integer|min:1',
        ]);

        // Logika kompleks update:
        // 1. Cek ketersediaan meja untuk kriteria baru.
        // 2. Jika tersedia, update data di tabel Reservation.
        // 3. Update data di tabel ReservationTable (ganti meja jika perlu).
        // 4. Kirim notifikasi perubahan.

        $reservation->update([
            'date' => $request->date,
            'time' => $request->time,
            'numOfPeople' => $request->numOfPeople,
            'status' => 'pending', // Ubah status menjadi pending atau confirmed lagi setelah cek meja
        ]);
        
        // Redirect kembali ke halaman detail
        return redirect()->route('booking.detail', ['id' => $reservation->reservationId])
                         ->with('success', 'Reservasi berhasil diperbarui. Meja baru sedang dicek.');
    }

    /**
     * Membatalkan reservasi yang dipilih pelanggan.
     * Corresponds to: Membatalkan Reservasi di Activity Diagram.
     */
    public function cancel(Reservation $reservation)
    {
        if ($reservation->status == 'cancel') {
            return back()->with('error', 'Reservasi ini sudah dibatalkan sebelumnya.');
        }
        
        // Update status reservasi menjadi 'cancel'
        $reservation->update(['status' => 'cancel']);

        // Logika kompleks:
        // 1. Meja yang sebelumnya terpesan harus diubah statusnya menjadi 'available' di TableList.
        // 2. Jika ada pembayaran (Payment status 'paid'), buat entri refund.
        // 3. Kirim notifikasi pembatalan.
        
        return redirect()->route('booking.detail', ['id' => $reservation->reservationId])
                         ->with('success', 'Reservasi berhasil dibatalkan. Dana (jika ada) sedang diproses.');
    }
}
