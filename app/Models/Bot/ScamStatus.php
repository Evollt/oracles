<?php

namespace App\Models\Bot;

use App\Models\Setting\Color;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScamStatus extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'color_id',
        'slug',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
