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
    use RefreshDatabase;

    /**
     * Setup: Membuat data yang diperlukan untuk testing (Customer, Table)
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 1. Buat User dan Customer untuk testing
        $user = User::create([
            'name' => 'Test Customer',
            'email' => 'test@customer.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        Customer::create([
            'userId' => $user->userId,
            'phoneNumber' => '081234567890',
        ]);

        // 2. Buat User dan Admin
        $adminUser = User::create([
            'name' => 'Test Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('adminpass'),
            'role' => 'admin',
        ]);
        
        \App\Models\Admin::create(['userId' => $adminUser->userId]);

        // 3. Buat Meja untuk testing
        TableList::create(['tableNumber' => 10, 'capacity' => 4, 'status' => 'available']);
        TableList::create(['tableNumber' => 11, 'capacity' => 6, 'status' => 'available']);
    }

    // =======================================================================
    // TEST FITUR PELANGGAN (RESERVASI)
    // =======================================================================
    
    #[Test]
    public function customer_can_access_homepage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Welcome to our family restaurant');
    }

    #[Test]
    public function customer_can_make_a_reservation()
    {
        $table = TableList::first();
        $customer = Customer::first();
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        // Data Reservasi yang akan diposting
        $reservationData = [
            'date' => $tomorrow,
            'time' => '19:00',
            'numOfPeople' => 4,
            'name' => 'Test Customer',
            'phoneNumber' => '081234567890',
            'email' => 'test@customer.com',
            'tableId' => $table->tableId,
            'paymentMethod' => 'Transfer',
        ];

        // 1. MENGAMBIL RESPON KE VARIABEL $response (PERBAIKAN UTAMA)
        $response = $this->withSession([
            'reservation_data' => $reservationData,
            'available_tables' => TableList::limit(1)->get()
        ])->post(route('reservation.store'), $reservationData);

        // 2. ASSERTION PADA RESPON YANG SUDAH DIAMBIL
        $response->assertSessionHas('success');
        $response->assertRedirect();
        // Memastikan URL redirection berisi path /reservation/success/
        $this->assertStringContainsString('/reservation/success/', $response->headers->get('Location'));

        // 3. Verifikasi Database: Reservasi tersimpan
        $this->assertDatabaseHas('Reservation', [
            'date' => $tomorrow,
            'numOfPeople' => 4,
            'customerId' => $customer->customerId,
            'status' => 'confirmed',
        ]);

        // 4. Verifikasi Relasi: Meja terasosiasi
        $reservation = Reservation::where('customerId', $customer->customerId)->first();
        $this->assertDatabaseHas('ReservationTable', [
            'reservationId' => $reservation->reservationId,
            'tableId' => $table->tableId,
        ]);
    }

    // =======================================================================
    // TEST FITUR ADMIN (CRUD MEJA)
    // =======================================================================

    #[Test]
    public function admin_can_create_a_new_table()
    {
        $adminUser = User::where('role', 'admin')->first();
        $this->actingAs($adminUser);

        $newTableData = [
            'tableNumber' => 15,
            'capacity' => 8,
            'status' => 'available',
        ];

        $response = $this->post(route('admin.tables.store'), $newTableData);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('table_lists', $newTableData);
    }

    #[Test]
    public function admin_can_update_table_capacity()
    {
        $adminUser = User::where('role', 'admin')->first();
        $this->actingAs($adminUser);

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

    #[Test]
    public function admin_can_delete_an_unused_table()
    {
        $adminUser = User::where('role', 'admin')->first();
        $this->actingAs($adminUser);

        $tableToDelete = TableList::where('tableNumber', 11)->first();

        $response = $this->delete(route('admin.tables.destroy', $tableToDelete->tableId));

        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('table_lists', ['tableId' => $tableToDelete->tableId]);
    }
}