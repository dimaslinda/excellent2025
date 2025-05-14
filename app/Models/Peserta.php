<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Peserta extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sekolah',
        'provinsi',
        'kota',
        'nomor_whatsapp_orang_tua',
        'nomor_whatsapp_guru',
        'email_guru',
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
}
