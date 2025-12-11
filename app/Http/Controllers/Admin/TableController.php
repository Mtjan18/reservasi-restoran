<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TableList;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    /**
     * Menampilkan daftar semua meja.
     * Corresponds to: Read (R) di CRUD Meja.
     */
    public function index()
    {
        $tables = TableList::orderBy('tableNumber', 'asc')->get();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Menampilkan formulir untuk membuat meja baru.
     * Corresponds to: Create (C) di CRUD Meja.
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Menyimpan meja yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tableNumber' => 'required|integer|unique:table_lists,tableNumber',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved,unavailable',
        ]);

        try {
            TableList::create($request->all());

            return redirect()->route('admin.tables.index')
                             ->with('success', 'Meja baru berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan meja. Pesan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan formulir untuk mengedit meja yang ditentukan.
     * Corresponds to: Update (U) di CRUD Meja.
     */
    public function edit(TableList $table)
    {
        // Variabel yang dilewatkan ke view adalah $table
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Memperbarui meja yang ditentukan di database.
     */
    public function update(Request $request, TableList $table)
    {
        $request->validate([
            // Pastikan tableNumber unik, kecuali untuk dirinya sendiri
            'tableNumber' => 'required|integer|unique:table_lists,tableNumber,' . $table->tableId . ',tableId',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved,unavailable',
        ]);

        try {
            $table->update($request->all());

            return redirect()->route('admin.tables.index')
                             ->with('success', 'Meja berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui meja. Pesan: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus meja dari database.
     * Corresponds to: Delete (D) di CRUD Meja.
     */
    public function destroy(TableList $table)
    {
        try {
            // Cek apakah meja ini sedang digunakan dalam reservasi aktif (ReservationTable)
            $isActive = DB::table('ReservationTable')
                          ->where('tableId', $table->tableId)
                          ->exists();
            
            if ($isActive) {
                return back()->with('error', 'Meja ini tidak dapat dihapus karena masih terkait dengan reservasi. Ubah status menjadi "unavailable" saja.');
            }

            $table->delete();
            
            return redirect()->route('admin.tables.index')
                             ->with('success', 'Meja berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus meja. Pesan: ' . $e->getMessage());
        }
    }
}