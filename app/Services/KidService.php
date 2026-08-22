<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Kid;
use App\Repositories\KidRepository;

class KidService
{
    public function __construct(
        private KidRepository $kids
    ) {
    }

    /**
     * @return array<Kid>
     */
    public function getAll(): array
    {
        return $this->kids->findAll();
    }

    public function getById(int $id): ?Kid
    {
        return $this->kids->findById($id);
    }

    /**
     * @return array<Kid>
     */
    public function getActive(): array
    {
        return $this->kids->findActive();
    }

    /**
     * @return array<Kid>
     */
    public function getFinished(): array
    {
        return $this->kids->findFinished();
    }

    public function create(array $data): void
    {
        $data['collected_amount'] = 0;
        $data['is_active'] = 1;

        $this->kids->create($data);
    }

    public function update(int $id, array $data): void
    {
        $this->kids->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->kids->delete($id);
    }
}