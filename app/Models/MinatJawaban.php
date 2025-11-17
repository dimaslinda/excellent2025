<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MinatJawaban extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'soal_id',
        'kode',
        'label',
        'value',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function soal(): BelongsTo
    {
        return $this->belongsTo(MinatSoal::class, 'soal_id');
    }

    public function registerMediaCollections(): void
    {
        $disk = config('filesystems.default') === 'gcs' ? 'gcs' : 'public';
        $this->addMediaCollection('answer_images')
            ->singleFile()
            ->useDisk($disk);
    }
}