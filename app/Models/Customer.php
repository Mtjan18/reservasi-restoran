<?php

// app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'Customer';
    protected $primaryKey = 'customerId';
    public $timestamps = false;
    
    protected $fillable = [
        'userId',
        'phoneNumber',
        // Note: 'name' dan 'email' seharusnya diisi melalui User model
    ];

    // Relasi ke User (Foreign Key ke User)
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }
    
    // Relasi ke Reservasi (One-to-Many: Satu Customer memiliki banyak Reservasi) 
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'customerId', 'customerId');
    }
}