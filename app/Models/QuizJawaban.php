<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizJawaban extends Model
{
    protected $fillable = [
        'soal_id',
        'jawaban',
        'gaya_belajar',
        'urutan',
    ];

    protected $casts = [
        'gaya_belajar' => 'string',
    ];

    public function soal(): BelongsTo
    {
        return $this->belongsTo(QuizSoal::class, 'soal_id');
    }
}
