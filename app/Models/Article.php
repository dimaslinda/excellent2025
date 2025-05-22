<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'twitter_title',
        'twitter_description',
        'canonical_url',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'meta_keywords' => 'array',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
