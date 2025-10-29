<?php

namespace Modules\SiteSettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = [
        'old_link',
        'new_link',
        'status',
    ];
}
