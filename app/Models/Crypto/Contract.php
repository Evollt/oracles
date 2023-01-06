<?php

namespace App\Models\Crypto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'address',
    ];

    public function nfts(): HasMany
    {
        return $this->hasMany(Nft::class);
    }
}
