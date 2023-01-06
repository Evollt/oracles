<?php

namespace App\Models\User;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Security extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_usage',
        'phishing_code',
        'inactive_timer',
    ];

    protected $casts = [
        'data_usage' => 'bool',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
