<?php

namespace Modules\NovaPoshta\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NpWarehouse extends Model
{
    protected $table = 'np_warehouses';

    protected $fillable = [
        'CityID',
        'Ref',
        'Description',
        'CityDescription',
        'ShortAddress',
        'Latitude',
        'Longitude'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(NpCity::class, 'CityRef', 'Ref');
    }
}
