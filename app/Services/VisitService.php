<?php

namespace App\Services;

use App\Repositories\Interfaces\VisitRepository;
use JetBrains\PhpStorm\NoReturn;

class VisitService
{

    public function __construct(private readonly VisitRepository $visitRepository)
    {
    }

    public function recordVisit($countryCode): void
    {
        $this->visitRepository->incrementVisit($countryCode);
    }

    #[NoReturn] public function getStatistics(): array
    {
        return $this->visitRepository->getStatistics();
    }
}

