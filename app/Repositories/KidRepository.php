<?php


declare(strict_types=1);

namespace App\Repositories;

use App\Core\QueryBuilder;
use App\Models\Kid;

class KidRepository
{
    public function __construct(
        private QueryBuilder $db
    )
    {
    }

    public function findActive(): array
    {
        // Получаем сырые данные из БД
        $rows = $this->db->get_where('kids', ['is_active' => 1]);

        // Превращаем каждую строку в объект Kid
        return array_map(fn($row) => $this->mapRowToModel($row), $rows);
    }

    public function findFinished(): array
    {
        $rows = $this->db->get_where('kids', ['is_active' => 0]);

        return array_map(fn($row) => $this->mapRowToModel($row), $rows);
    }

    // Вспомогательный метод для маппинга строки БД → объект Kid
    private function mapRowToModel(array $row): Kid
    {
        return new Kid(
            id: (int)$row['id'],
            name: $row['name'] ?? null,
            lastName: $row['last_name'] ?? null, // или как у тебя в БД колонка
            history: $row['history'] ?? null,
            sum1: $row['sum1'] ?? null,
            sum2: $row['sum2'] ?? null,
            avatar: $row['avatar'] ?? null,
            isActive: (bool)$row['is_active'],
        );
    }
}


//declare(strict_types=1);
//
//namespace App\Repositories;
//
//use App\Core\QueryBuilder;
//
//class KidRepository
//{
//    public function __construct(
//        private QueryBuilder $db
//    ) {
//    }
//
//    public function findActive(): array
//    {
//        return $this->db->get_where(
//            'kids',
//            ['is_active' => 1]
//        );
//    }
//
//    public function findFinished(): array
//    {
//        return $this->db->get_where(
//            'kids',
//            ['is_active' => 0]
//        );
//    }
//}