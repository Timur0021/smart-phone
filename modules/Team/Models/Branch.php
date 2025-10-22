<?php

namespace Modules\Team\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'locale',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'branch_id');
    }
}
