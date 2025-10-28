<?php

namespace Modules\Pages\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FooterPage extends Pivot
{
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $table = 'footer_to_page';

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery()
    {
        return static::query()
            ->where('footer_id', $this->footer_id);
    }
}
