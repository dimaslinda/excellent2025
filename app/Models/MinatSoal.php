<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;

class MinatSoal extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'pertanyaan',
        'jenjang',
        'tingkatan_sd',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jawaban(): HasMany
    {
        return $this->hasMany(MinatJawaban::class, 'soal_id');
    }

    public function registerMediaCollections(): void
    {
        $disk = config('filesystems.default') === 'gcs' ? 'gcs' : 'public';
        $this->addMediaCollection('minat_soal_images')
            ->singleFile()
            ->useDisk($disk);
    }

    // Tidak ada media conversion; gunakan gambar asli di UI
}