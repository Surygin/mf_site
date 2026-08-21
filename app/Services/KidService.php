<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\KidRepository;

class KidService
{
    private KidRepository $kids;

    public function __construct(KidRepository $kids)
    {
        $this->kids = $kids;
    }

    // Теперь это возвращает array<Kid>
    public function getActive(): array
    {
        return $this->kids->findActive();
    }

    public function getFinished(): array
    {
        return $this->kids->findFinished();
    }
}


//namespace App\Services;
//
//use App\Repositories\KidRepository;
//
//class KidService
//{
//    public function __construct(
//        private KidRepository $kids
//    ) {
//    }
//
//    public function getActive(): array
//    {
//        return $this->kids->findActive();
//    }
//
//    public function getFinished(): array
//    {
//        return $this->kids->findFinished();
//    }
//}
