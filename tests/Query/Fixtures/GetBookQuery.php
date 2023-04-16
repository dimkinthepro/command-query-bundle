<?php

declare(strict_types=1);

namespace DimkinThePro\CommandQuery\Tests\Query\Fixtures;

use DimkinThePro\CommandQuery\Query\QueryInterface;

class GetBookQuery implements QueryInterface
{
    public function __construct(
        public readonly string $author
    ) {
    }
}
