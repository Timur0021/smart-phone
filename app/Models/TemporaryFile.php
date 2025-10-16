<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Team\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TemporaryFile extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void {
        $this->addMediaCollection('temporary_files')->singleFile();
    }

    public static function transferFilesTo(Model|Authenticatable|User|null $model, int $id, string $collection_name = 'image'):void
    {

        $model->clearMediaCollection($collection_name);

        Media::query()
            ->where('model_type', TemporaryFile::class)
            ->where('model_id', $id)
            ->update([
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'collection_name' => $collection_name,
            ]);
    }
}
