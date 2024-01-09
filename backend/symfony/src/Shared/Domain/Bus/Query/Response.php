<?php

namespace App\Shared\Domain\Bus\Query;

interface Response
{
    public function handle(Query $query): void;
}
