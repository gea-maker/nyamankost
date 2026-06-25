<?php
// app/Models/LoginAttempt.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    protected $fillable = [
        'email',
        'ip_address',
        'attempts',
        'locked_until',
    ];

    protected $casts = [
        'locked_until' => 'datetime',
    ];

    public function isLocked(): bool
    {
        return $this->locked_until && now()->lessThan($this->locked_until);
    }

    public function secondsRemaining(): int
    {
        if (!$this->isLocked()) return 0;
        return (int) now()->diffInSeconds($this->locked_until);
    }
}