<?php

namespace App\Shared\Domain\Bus\Query;

interface QueryBus
{
    public function handle(Query $query);
}
