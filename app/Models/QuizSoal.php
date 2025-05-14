<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizSoal extends Model
{
    protected $fillable = [
        'pertanyaan',
        'kategori',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jawaban(): HasMany
    {
        return $this->hasMany(QuizJawaban::class, 'soal_id');
    }
}
