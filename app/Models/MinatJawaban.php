<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinatJawaban extends Model
{
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
}