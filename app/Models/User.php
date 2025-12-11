<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'User'; // Nama tabel Anda di database
    protected $primaryKey = 'userId'; // Primary Key
    public $timestamps = false; // Karena skema Anda tidak menyertakan created_at/updated_at

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 'admin' atau 'customer'
    ];

    protected $hidden = [
        'password',
    ];
    
    // Relasi ke Customer (One-to-One)
    public function customer()
    {
        return $this->hasOne(Customer::class, 'userId', 'userId');
    }
    
    // Relasi ke Admin (One-to-One)
    public function admin()
    {
        return $this->hasOne(Admin::class, 'userId', 'userId');
    }
}