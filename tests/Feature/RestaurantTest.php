<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use App\Models\TableList;
use App\Models\Reservation;
use App\Models\ReservationTable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;

class RestaurantTest extends TestCase
{
    // Menggunakan RefreshDatabase untuk me-reset database sebelum setiap test
    use RefreshDatabase;

    protected $testAdminEmail = 'test@admin.com';
    protected $testAdminPass = 'adminpass';
    protected $testCustomerEmail = 'test@customer.com';
    protected $testCustomerPhone = '081234567890';

    /**
     * Setup: Membuat data yang diperlukan untuk testing (Customer, Admin, Table)
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 1. Buat User dan Customer untuk testing
        $user = User::create([
            'name' => 'Test Customer',
            'email' => $this->testCustomerEmail,
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        Customer::create([
            'userId' => $user->userId,
            'phoneNumber' => $this->testCustomerPhone,
        ]);

        // 2. Buat User dan Admin
        $adminUser = User::create([
            'name' => 'Test Admin',
            'email' => $this->testAdminEmail,
            'password' => Hash::make($this->testAdminPass),
            'role' => 'admin',
        ]);
        
        \App\Models\Admin::create(['userId' => $adminUser->userId]);

        // 3. Buat Meja untuk testing
        TableList::create(['tableNumber' => 10, 'capacity' => 4, 'status' => 'available']);
        TableList::create(['tableNumber' => 11, 'capacity' => 6, 'status' => 'available']);
    }

    // TEST CASES MODUL PELANGGAN

    #[Test] // P-1: Akses Homepage
    public function customer_can_access_homepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Welcome to our family restaurant');
    }

    #[Test] // P-2: Reservasi Sukses
    public function customer_can_make_a_reservation()
    {
        $table = TableList::where('capacity', 4)->first();
        $customer = Customer::first();
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $reservationData = [
            'date' => $tomorrow,
            'time' => '19:00',
            'numOfPeople' => 4,
            'name' => 'Test Customer',
            'phoneNumber' => $this->testCustomerPhone,
            'email' => $this->testCustomerEmail,
            'tableId' => $table->tableId,
            'paymentMethod' => 'Transfer',
        ];

        // Simulasi flow: Cek Ketersediaan -> Store
        $response = $this->withSession([
            'reservation_data' => $reservationData,
            'available_tables' => TableList::limit(1)->get()
        ])->post(route('reservation.store'), $reservationData);

        $response->assertSessionHas('success');
        $this->assertStringContainsString('/reservation/success/', $response->headers->get('Location'));

        $this->assertDatabaseHas('Reservation', ['date' => $tomorrow, 'status' => 'confirmed']);
    }

    #[Test] // P-3: Reservasi Gagal (Tanggal Lampau)
    public function customer_cannot_reserve_past_date()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');

        $reservationData = [
            'date' => $yesterday,
            'time' => '19:00',
            'numOfPeople' => 2,
            'name' => 'Invalid Customer',
            'phoneNumber' => '08000',
            'email' => 'invalid@customer.com',
        ];

        // Coba POST ke checkAvailability (yang melakukan validasi)
        $response = $this->post(route('reservation.check'), $reservationData);

        // Harapan: Redirect back (status 302) dengan error validasi
        $response->assertSessionHasErrors(['date']);
        $response->assertStatus(302);
    }
    
    #[Test] // P-4: Cek Booking (Berhasil)
    public function customer_can_check_their_booking_using_code()
    {
        $reservation = Reservation::create([
            'date' => Carbon::tomorrow()->format('Y-m-d'),
            'time' => '19:00',
            'numOfPeople' => 2,
            'bookingCode' => 'TESTCODE',
            'customerId' => Customer::first()->customerId,
        ]);

        $response = $this->post(route('booking.check.result'), [
            'bookingCode' => 'TESTCODE',
            'phoneNumber' => '', // Phone number dikosongkan
        ]);

        // Harapan: Status OK dan menampilkan kode booking di halaman detail
        $response->assertStatus(200);
        $response->assertSee('TESTCODE');
    }

    #[Test] // P-5: Pembatalan Reservasi
    public function customer_can_cancel_their_reservation()
    {
        $reservation = Reservation::create([
            'date' => Carbon::tomorrow()->format('Y-m-d'),
            'time' => '19:00',
            'numOfPeople' => 2,
            'bookingCode' => 'CANCELME',
            'customerId' => Customer::first()->customerId,
            'status' => 'confirmed'
        ]);

        $response = $this->put(route('reservation.cancel', $reservation->reservationId));

        $response->assertSessionHas('success', 'Reservasi berhasil dibatalkan. Dana (jika ada) sedang diproses.');
        $this->assertDatabaseHas('Reservation', [
            'reservationId' => $reservation->reservationId,
            'status' => 'cancel'
        ]);
    }

    // TEST CASES MODUL ADMIN
    
    #[Test] // A-1: Login Sukses
    public function admin_can_login_successfully()
    {
        $response = $this->post(route('admin.login.attempt'), [
            'email' => $this->testAdminEmail,
            'password' => $this->testAdminPass,
        ]);
        
        // Harapan: Redirect ke dashboard (route admin.dashboard)
        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }
    
    #[Test] // A-2: Login Gagal (Role Non-Admin)
    public function user_with_customer_role_cannot_login_as_admin()
    {
        // Coba login menggunakan kredensial customer
        $response = $this->post(route('admin.login.attempt'), [
            'email' => $this->testCustomerEmail,
            'password' => 'password',
        ]);
        
        // Harapan: Redirect back ke login dengan error
        $response->assertSessionHas('error', 'Akses ditolak. Hanya akun Admin yang dapat masuk.');
        $this->assertGuest();
    }


    #[Test] // A-3: CRUD: Create Meja
    public function admin_can_create_a_new_table()
    {
        // Login sebagai Admin
        $this->actingAs(User::where('role', 'admin')->first());

        $newTableData = [
            'tableNumber' => 15,
            'capacity' => 8,
            'status' => 'available',
        ];

        $response = $this->post(route('admin.tables.store'), $newTableData);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('table_lists', $newTableData);
    }

    #[Test] // A-4: CRUD: Update Meja
    public function admin_can_update_table_capacity()
    {
        // Login sebagai Admin
        $this->actingAs(User::where('role', 'admin')->first());

        $table = TableList::where('tableNumber', 10)->first();

        $updatedData = [
            'tableNumber' => 10, 
            'capacity' => 5, 
            'status' => 'available',
        ];

        $response = $this->put(route('admin.tables.update', $table->tableId), $updatedData);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('table_lists', ['tableId' => $table->tableId, 'capacity' => 5]);
    }

    #[Test] // A-5: CRUD: Delete Meja Sukses
    public function admin_can_delete_an_unused_table()
    {
        // Login sebagai Admin
        $this->actingAs(User::where('role', 'admin')->first());

        $tableToDelete = TableList::where('tableNumber', 11)->first();

        $response = $this->delete(route('admin.tables.destroy', $tableToDelete->tableId));

        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('table_lists', ['tableId' => $tableToDelete->tableId]);
    }
    
    #[Test] // A-6: CRUD: Delete Meja Gagal (Ada Relasi)
    public function admin_cannot_delete_a_reserved_table()
    {
        // Login sebagai Admin
        $this->actingAs(User::where('role', 'admin')->first());

        $table = TableList::where('tableNumber', 10)->first();
        $reservation = Reservation::create([
            'date' => Carbon::tomorrow()->format('Y-m-d'),
            'time' => '18:00',
            'numOfPeople' => 4,
            'bookingCode' => 'DELETEFAIL',
            'customerId' => Customer::first()->customerId,
            'status' => 'confirmed'
        ]);
        ReservationTable::create(['reservationId' => $reservation->reservationId, 'tableId' => $table->tableId, 'assignedAt' => now()]);

        // Coba hapus meja yang sudah terikat
        $response = $this->delete(route('admin.tables.destroy', $table->tableId));

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('table_lists', ['tableId' => $table->tableId]); // Meja harus tetap ada
    }
}