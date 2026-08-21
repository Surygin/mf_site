<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

class QueryBuilder
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function get_all(string $table): array
    {
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<array<string, mixed>>
     */
    public function get_all_docs(string $table, int $id): array
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE kids_id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<string, mixed>|false
     */
    public function get_one(string $table, int $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create(string $table, array $data): void
    {
        if (empty($data)) {
            return;
        }

        $keys = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$placeholders})";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function update(string $table, array $data, int $id): void
    {
        if (empty($data)) {
            return;
        }

        $parts = [];
        foreach (array_keys($data) as $key) {
            $parts[] = "{$key} = :{$key}";
        }
        $setClause = implode(', ', $parts);

        $data['id'] = $id;

        $sql = "UPDATE {$table} SET {$setClause} WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute($data);
    }

    public function delete(string $table, int $id): void
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
