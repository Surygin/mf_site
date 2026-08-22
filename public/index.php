<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

use App\Controllers\HomeController;
use App\Repositories\KidRepository;
use App\Services\KidService;

$kidRepository = new KidRepository($db);
$kidService = new KidService($kidRepository);

$controller = new HomeController($kidService);

$controller->index();