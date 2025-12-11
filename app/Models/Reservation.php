<?php

// app/Models/Reservation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    protected $table = 'Reservation';
    protected $primaryKey = 'reservationId';
    public $timestamps = false;
    
    protected $fillable = [
        'date',
        'time',
        'numOfPeople',
        'bookingCode',
        'status', // pending, confirmed, cancel
        'customerId',
    ];

    // Relasi ke Customer (Many-to-One) 
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId', 'customerId');
    }
    
    // Relasi ke Table (Many-to-Many melalui ReservationTable) 
    public function assignedTables()
    {
        return $this->hasMany(ReservationTable::class, 'reservationId', 'reservationId');
    }
    
    // Relasi ke Pembayaran (One-to-One) 
    public function payment()
    {
        return $this->hasOne(Payment::class, 'reservationId', 'reservationId');
    }
    
    // Relasi ke Notifikasi (One-to-Many) 
    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'reservationId', 'reservationId');
    }
}