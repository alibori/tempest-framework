<?php

declare(strict_types=1);

namespace Tempest\Database;

final class DatabaseConfig
{
    private array $migrations = [];

    public function __construct(
        public DatabaseConnection $connection,
    ) {
    }

    public function connection(): DatabaseConnection
    {
        return $this->connection;
    }

    public function addMigration(Migration|string $migration): self
    {
        $this->migrations[] = $migration;

        return $this;
    }

    public function setMigrations(array $migrations): void
    {
        $this->migrations = $migrations;
    }

    public function getMigrations(): array
    {
        return $this->migrations;
    }
}