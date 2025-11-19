<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizHasil extends Model
{
    protected $fillable = [
        'peserta_id',
        'gaya_belajar',
        'skor_visual',
        'skor_auditori',
        'skor_kinestetik',
        'skor_readwrite',
        'minat_summary',
        'profil_summary',
    ];

    protected $casts = [
        'minat_summary' => 'array',
        'profil_summary' => 'array',
    ];

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class);
    }
}
