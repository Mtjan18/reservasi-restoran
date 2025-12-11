<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;

    protected $table = 'Authentication';
    protected $primaryKey = 'sessionId';
    public $incrementing = false; // Karena sessionId adalah VARCHAR
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'sessionId',
        'loginTime',
        'userId',
    ];

    /**
     * Relasi ke User (Many-to-One)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }
}