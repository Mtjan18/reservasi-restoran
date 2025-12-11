<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'Notifications';
    protected $primaryKey = 'notificationId';
    public $timestamps = false;

    protected $fillable = [
        'reservationId',
        'message',
        'sentAt',
        'type', // email, SMS, app
    ];

    // Relasi ke Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservationId', 'reservationId');
    }
}