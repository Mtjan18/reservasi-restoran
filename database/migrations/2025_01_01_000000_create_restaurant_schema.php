<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. User Table (Parent class Admin & Customer)
        Schema::create('User', function (Blueprint $table) {
            $table->id('userId');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->enum('role', ['admin', 'customer']);
        });

        // 2. Authentication
        Schema::create('Authentication', function (Blueprint $table) {
            $table->string('sessionId', 255)->primary();
            $table->dateTime('loginTime');
            $table->foreignId('userId')->constrained('User', 'userId')->cascadeOnDelete();
        });

        // 3. Admin Table (Inheritance from User)
        Schema::create('Admin', function (Blueprint $table) {
            $table->id('employeeId');
            $table->foreignId('userId')->unique()->constrained('User', 'userId')->cascadeOnDelete();
        });

        // 4. Customer Table (Inheritance from User)
        Schema::create('Customer', function (Blueprint $table) {
            $table->id('customerId');
            $table->foreignId('userId')->unique()->constrained('User', 'userId')->cascadeOnDelete();
            $table->string('phoneNumber', 20)->nullable();
        });

        // 5. Reservation
        Schema::create('Reservation', function (Blueprint $table) {
            $table->id('reservationId');
            $table->date('date');
            $table->time('time');
            $table->integer('numOfPeople');
            $table->string('bookingCode', 50)->unique();
            $table->enum('status', ['pending', 'confirmed', 'cancel'])->default('pending');
            $table->foreignId('customerId')->constrained('Customer', 'customerId')->cascadeOnDelete();
        });

        // 6. Table (Restaurant Table)
        Schema::create('table_lists', function (Blueprint $table) {
            $table->id('tableId');
            $table->integer('tableNumber')->unique();
            $table->integer('capacity');
            $table->enum('status', ['available', 'reserved', 'unavailable'])->default('available');
        });

        // 7. ReservationTable (Many-to-many)
        Schema::create('ReservationTable', function (Blueprint $table) {
            $table->foreignId('reservationId')->constrained('Reservation', 'reservationId')->cascadeOnDelete();
            $table->foreignId('tableId')->constrained('table_lists', 'tableId')->cascadeOnDelete();
            $table->dateTime('assignedAt');
            $table->primary(['reservationId', 'tableId']);
        });

        // 8. Payment
        Schema::create('Payment', function (Blueprint $table) {
            $table->id('paymentId');
            $table->foreignId('reservationId')->unique()->constrained('Reservation', 'reservationId')->cascadeOnDelete();
            $table->double('amount');
            $table->enum('method', ['Transfer', 'QRIS', 'Cash']);
            $table->enum('status', ['paid', 'unpaid', 'refunded'])->default('unpaid');
            $table->dateTime('paymentDate')->nullable();
        });

        // 9. Notifications
        Schema::create('Notifications', function (Blueprint $table) {
            $table->id('notificationId');
            $table->foreignId('reservationId')->constrained('Reservation', 'reservationId')->cascadeOnDelete();
            $table->text('message');
            $table->dateTime('sentAt');
            $table->enum('type', ['email', 'SMS', 'app']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Notifications');
        Schema::dropIfExists('Payment');
        Schema::dropIfExists('ReservationTable');
        Schema::dropIfExists('table_lists');
        Schema::dropIfExists('Reservation');
        Schema::dropIfExists('Customer');
        Schema::dropIfExists('Admin');
        Schema::dropIfExists('Authentication');
        Schema::dropIfExists('User');
    }
};