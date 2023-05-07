<?php

declare(strict_types=1);

namespace DimkinThePro\CommandQuery\Tests\Query\Fixtures;

use DimkinThePro\CommandQuery\Query\QueryHandlerInterface;

class GetBookQueryHandler implements QueryHandlerInterface
{
    public function __invoke(GetBookQuery $query): ?Book
    {
        $books = [new Book()];

        foreach ($books as $book) {
            if ($book->author === $query->author) {
                return $book;
            }
        }

        return null;
    }
}
