<?php

namespace Modules\Team\GraphQL\Queries;

class Hello
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return 'Hello World!';
    }
}
