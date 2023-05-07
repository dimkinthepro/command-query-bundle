<?php

declare(strict_types=1);

namespace DimkinThePro\CommandQuery\Query;

interface QueryBusInterface
{
    public function execute(QueryInterface $query): mixed;
}
