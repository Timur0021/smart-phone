<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackPage extends Model
{
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery()
    {
        return static::query()
            ->where('page_id', $this->page_id);
    }
}
