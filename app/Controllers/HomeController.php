<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\KidService;

class HomeController
{
    public function __construct(
        private KidService $kidService
    ) {
    }

    public function index(): void
    {
        $activeKids = $this->kidService->getActive();
        $finishedKids = $this->kidService->getFinished();

        require PROJECT_ROOT . '/app/Views/home.php';
    }
}