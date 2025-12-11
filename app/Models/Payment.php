<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'Payment';
    protected $primaryKey = 'paymentId';
    public $timestamps = false;

    protected $fillable = [
        'reservationId',
        'amount',
        'method',
        'status', // paid, unpaid, refunded
        'paymentDate',
    ];

    // Relasi ke Reservation (One-to-One)
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservationId', 'reservationId');
    }
}