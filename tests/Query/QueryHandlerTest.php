<?php

declare(strict_types=1);

namespace DimkinThePro\CommandQuery\Tests\Query;

use DimkinThePro\CommandQuery\Query\QueryBus;
use DimkinThePro\CommandQuery\Query\QueryBusInterface;
use DimkinThePro\CommandQuery\Tests\Query\Fixtures\Book;
use DimkinThePro\CommandQuery\Tests\Query\Fixtures\GetBookQuery;
use DimkinThePro\CommandQuery\Tests\Query\Fixtures\GetBookQueryHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class QueryHandlerTest extends TestCase
{
    /** @dataProvider providerTestCase */
    public function testCate(string $author, bool $assertion): void
    {
        $queryBus = $this->createQueryBus();
        $command = new GetBookQuery($author);

        $book = $queryBus->execute($command);
        if (false === $assertion) {
            self::assertNull($book);
        } else {
            self::assertInstanceOf(Book::class, $book);
            self::assertEquals($book->author, $author);
        }
    }

    public function providerTestCase(): array
    {
        return [
            'success' => ['Doe John', true],
            'false' => ['John Doe', false],
        ];
    }

    private function createQueryBus(): QueryBusInterface
    {
        $handler = new GetBookQueryHandler();

        $messageBus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                GetBookQuery::class => [$handler],
            ])),
        ]);

        return new QueryBus($messageBus);
    }
}
