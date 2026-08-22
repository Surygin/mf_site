<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\QueryBuilder;
use App\Models\Kid;

class KidRepository
{
    public function __construct(
        private QueryBuilder $db
    ) {
    }

    /**
     * Получить всех детей.
     *
     * @return array<Kid>
     */
    public function findAll(): array
    {
        $rows = $this->db->get_all('kids');

        return array_map(
            fn(array $row): Kid => $this->mapRowToModel($row),
            $rows
        );
    }

    /**
     * Получить ребёнка по ID.
     */
    public function findById(int $id): ?Kid
    {
        $row = $this->db->get_one('kids', $id);

        if ($row === false) {
            return null;
        }

        return $this->mapRowToModel($row);
    }

    /**
     * Создать ребёнка.
     */
    public function create(array $data): void
    {
        $this->db->create('kids', $data);
    }

    /**
     * Обновить ребёнка.
     */
    public function update(int $id, array $data): void
    {
        $this->db->update('kids', $data, $id);
    }

    /**
     * Удалить ребёнка.
     */
    public function delete(int $id): void
    {
        $this->db->delete('kids', $id);
    }

    public function findActive(): array
    {
        $rows = $this->db->get_where('kids', ['is_active' => 1]);

        return array_map(
            fn(array $row): Kid => $this->mapRowToModel($row),
            $rows
        );
    }

    public function findFinished(): array
    {
        $rows = $this->db->get_where('kids', ['is_active' => 0]);

        return array_map(
            fn(array $row): Kid => $this->mapRowToModel($row),
            $rows
        );
    }

    /**
     * Преобразование строки БД в модель Kid.
     */
    private function mapRowToModel(array $row): Kid
    {
        return new Kid(
            id: (int) $row['id'],
            name: $row['name'] ?? null,
            lastName: $row['last_name'] ?? null,
            history: $row['history'] ?? null,
            collected_amount: isset($row['collected_amount'])
                ? (int) $row['collected_amount']
                : null,
            target_amount: isset($row['target_amount'])
                ? (int) $row['target_amount']
                : null,
            avatar: $row['avatar'] ?? null,
            isActive: (bool) $row['is_active'],
        );
    }
}