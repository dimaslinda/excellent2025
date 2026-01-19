<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ebook extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $disk = config('filesystems.default') === 'gcs' ? 'gcs' : 'public';

        $this->addMediaCollection('ebook_cover')
            ->singleFile()
            ->useDisk($disk);

        $this->addMediaCollection('ebook_file')
            ->singleFile()
            ->useDisk($disk);
    }
}
