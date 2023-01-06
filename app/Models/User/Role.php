<?php

namespace App\Models\User;

use App\Models\Setting\Color;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
        'slug'
    ];

    protected $with = [
        'permissions',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
