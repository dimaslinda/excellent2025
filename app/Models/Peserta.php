<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// Manipulations and conversion model imports removed as we no longer use conversions

class Peserta extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'sekolah',
        'jenjang',
        'tingkatan_sd',
        'provinsi',
        'kota',
        'nomor_whatsapp_orang_tua',
        'nomor_whatsapp_guru',
        'email_guru',
        'nisn',
        'foto_path',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($peserta) {
            $peserta->slug = Str::slug($peserta->name);
        });

        static::updating(function ($peserta) {
            if ($peserta->isDirty('name')) {
                $peserta->slug = Str::slug($peserta->name);
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $disk = config('filesystems.default') === 'gcs' ? 'gcs' : 'public';
        $this->addMediaCollection('photo')
            ->singleFile()
            ->useDisk($disk);
    }

    // Image conversions removed to use original images only
}
