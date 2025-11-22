<?php

namespace Modules\Request\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'phone',
        'request_status',
    ];
}
