<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\QueryBuilder;

class KidRepository
{
    public function __construct(
        private QueryBuilder $db
    ) {
    }

    public function findActive(): array
    {
        return $this->db->get_where(
            'kids',
            ['is_active' => 1]
        );
    }

    public function findFinished(): array
    {
        return $this->db->get_where(
            'kids',
            ['is_active' => 0]
        );
    }
}