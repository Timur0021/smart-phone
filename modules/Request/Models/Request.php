<?php

namespace Modules\Request\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'message',
        'request_status',
    ];
}
