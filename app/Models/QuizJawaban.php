<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class QuizJawaban extends Model implements HasMedia
{
    use InteractsWithMedia;

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

    public function registerMediaCollections(): void
    {
        $disk = config('filesystems.default') === 'gcs' ? 'gcs' : 'public';
        $this->addMediaCollection('answer_images')
            ->singleFile()
            ->useDisk($disk);
    }
}
