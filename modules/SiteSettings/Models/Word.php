<?php

namespace Modules\SiteSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Spatie\Translatable\HasTranslations;

class Word extends Model
{
    use HasTranslations;
    use ModelTree;

    protected $table = 'words';

    protected $fillable = [
        'name',
        'link',
        'active',
    ];

    public array $translatable = [
        'name',
        'link',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
