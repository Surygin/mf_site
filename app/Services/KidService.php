<?php

namespace App\Services;

use App\Repositories\KidRepository;

class KidService
{
    public function __construct(
        private KidRepository $kids
    ) {
    }

    public function getActive(): array
    {
        return $this->kids->findActive();
    }

    public function getFinished(): array
    {
        return $this->kids->findFinished();
    }
}
