<?php

namespace Modules\SiteSettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telegram extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'chat_id',
        'first_name',
        'user_name',
        'status',
    ];
}
