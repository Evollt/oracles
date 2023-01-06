<?php

namespace App\Models\Bot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scam extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_title',
        'old_text',
        'post_title',
        'post_text',
        'post_image',
        'images',
        'scam_status_id',
        'scam_status_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function scamStatus(): BelongsTo
    {
        return $this->belongsTo(ScamStatus::class);
    }

    public function scamCategory(): BelongsTo
    {
        return $this->belongsTo(ScamCategory::class);
    }
}
