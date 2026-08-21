<?php
namespace App\Services;

use App\Core\QueryBuilder;

class KidService
{
    private QueryBuilder $db;

    public function __construct(QueryBuilder $db)
    {
        $this->db = $db;
    }

    public function getActive(): array
    {
        $all = $this->db->get_all('kids');
        return array_filter($all, fn($k) => $k['is_active'] === 1);
    }

    public function getFinished(): array
    {
        $all = $this->db->get_all('kids');
        return array_filter($all, fn($k) => $k['status'] === 'finished');
    }
}
