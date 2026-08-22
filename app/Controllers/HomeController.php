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

        global $db, $appUrl;

        $activeKids = $this->kidService->getActive();
        $finishedKids = $this->kidService->getFinished();

        include PROJECT_ROOT . '/public/header.php';
        include PROJECT_ROOT . '/app/Views/home.php';
        include PROJECT_ROOT . '/public/footer.php';
    }
}