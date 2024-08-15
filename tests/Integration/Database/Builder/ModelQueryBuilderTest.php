<?php

declare(strict_types=1);

namespace Tests\Tempest\Integration\Database\Builder;

use Tempest\Database\Migrations\CreateMigrationsTable;
use Tests\Tempest\Fixtures\Migrations\CreateAuthorTable;
use Tests\Tempest\Fixtures\Migrations\CreateBookTable;
use Tests\Tempest\Fixtures\Modules\Books\Models\Book;
use Tests\Tempest\Integration\FrameworkIntegrationTestCase;

/**
 * @internal
 * @small
 */
class ModelQueryBuilderTest extends FrameworkIntegrationTestCase
{
    public function test_order_by(): void
    {
        $this->migrate(
            CreateMigrationsTable::class,
            CreateAuthorTable::class,
            CreateBookTable::class,
        );

        (Book::new(title: 'A'))->save();
        (Book::new(title: 'B'))->save();
        (Book::new(title: 'C'))->save();
        (Book::new(title: 'D'))->save();

        $book = Book::query()->orderBy('title DESC')->first();

        $this->assertSame('D', $book->title);
    }

    public function test_limit(): void
    {
        $this->migrate(
            CreateMigrationsTable::class,
            CreateAuthorTable::class,
            CreateBookTable::class,
        );

        (Book::new(title: 'A'))->save();
        (Book::new(title: 'B'))->save();
        (Book::new(title: 'C'))->save();
        (Book::new(title: 'D'))->save();

        $books = Book::query()->limit(2)->all();

        $this->assertCount(2, $books);
        $this->assertSame('A', $books[0]->title);
        $this->assertSame('B', $books[1]->title);
    }

    public function test_raw(): void
    {
        $this->migrate(
            CreateMigrationsTable::class,
            CreateAuthorTable::class,
            CreateBookTable::class,
        );

        (Book::new(title: 'A'))->save();
        $books = Book::query()->raw('LIMIT 1')->all();

        $this->assertCount(1, $books);
        $this->assertSame('A', $books[0]->title);
    }
}