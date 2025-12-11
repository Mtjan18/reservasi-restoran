<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ReservationTable extends Pivot
{
    use HasFactory;

    protected $table = 'ReservationTable';
    // Laravel secara default tidak menangani primary key komposit, jadi kita definisikan field yang fillable
    public $incrementing = false; // Primary key komposit
    public $timestamps = false;
    
    protected $fillable = [
        'reservationId',
        'tableId',
        'assignedAt',
    ];
    
    // Relasi ke Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservationId', 'reservationId');
    }
    
    // Relasi ke TableList
    public function table()
    {
        return $this->belongsTo(TableList::class, 'tableId', 'tableId');
    }
}