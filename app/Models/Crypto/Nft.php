<?php

namespace App\Models\Crypto;

use App\Models\File\File;
use App\Models\Crypto\Wallet;
use App\Models\Crypto\Contract;
use App\Models\Crypto\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nft extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'token_id',
        'opensea_link',
        'contract_id',
        'wallet_id',
    ];

    protected $casts = [
        'token_id' => 'int',
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function getOpenseaLinkAttribute(){
        if(true === env('USE_TESTNET')){
            return 'https://testnets.opensea.io/assets/rinkeby/' . $this->contract->address . '/' . $this->token_id;
        }
    }
}
