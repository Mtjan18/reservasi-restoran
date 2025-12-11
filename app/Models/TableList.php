<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableList extends Model
{
    use HasFactory;
    
    // Perbaikan: Secara eksplisit mendefinisikan nama tabel yang benar sesuai skema MySQL Anda
    protected $table = 'table_lists'; 
    protected $primaryKey = 'tableId';
    public $timestamps = false;
    
    protected $fillable = [
        'tableNumber',
        'capacity',
        'status', // available, reserved, unavailable
    ];
    
    // Relasi ke ReservationTable (Many-to-Many)
    public function reservations()
    {
        return $this->hasMany(ReservationTable::class, 'tableId', 'tableId');
    }
}