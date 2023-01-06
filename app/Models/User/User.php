<?php

namespace App\Models\User;

use App\Models\Crypto\Nft;
use App\Models\Crypto\Wallet;
use App\Models\Setting\FilterContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->guid = Uuid::uuid4()->toString();
    }

    protected $fillable = [
        'id',
        'email',
        'verification_code',
        'email_verified_at',
        'guid',
        'security_id',
        'notification_id',
        'deactivated_at',
        'username',
        'discriminator',
        'avatar',
        'verified',
        'locale',
        'mfa_enabled',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'refresh_token',
    ];

    protected $casts = [
        'use_nft' => 'bool',
        'deactivated_at' => 'datetime',
    ];

    public function security(): BelongsTo
    {
        return $this->belongsTo(Security::class);
    }

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class);
    }

    public function getProfileImageAttribute(){
        return "https://cdn.discordapp.com/avatars/" . $this->id. "/" . $this->avatar . ".png";
    }

    public function getDiscordAttribute(){
        return $this->username . "#" . $this->discriminator;
    }
}
