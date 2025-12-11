<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'Admin';
    protected $primaryKey = 'employeeId';
    public $timestamps = false;

    protected $fillable = [
        'userId',
    ];

    /**
     * Relasi ke User (One-to-One: Admin memiliki satu User record)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }
}