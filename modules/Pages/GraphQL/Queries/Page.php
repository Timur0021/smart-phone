<?php

namespace Modules\Pages\GraphQL\Queries;

use Modules\Pages\Services\PagesService;
use Illuminate\Database\Eloquent\Model;

class Page
{
    protected PagesService $pages;

    /**
     * @return void
     */
    public function __construct(PagesService $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args): Model
    {
        return $this->pages->find($args['slug']);
    }
}
