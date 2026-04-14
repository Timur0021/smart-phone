<?php

namespace Modules\NovaPoshta\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NpCity extends Model
{
    protected $table = 'np_cities';

    protected $fillable = [
        'Description',
        'SettlementTypeDescription',
        'Ref',
        'CityID',
    ];

    public function warehouses(): HasMany
    {
        return $this->hasMany(NpWarehouse::class, 'CityRef', 'Ref');
    }
}
