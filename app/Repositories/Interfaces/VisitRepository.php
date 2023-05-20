<?php

namespace App\Repositories\Interfaces;
interface VisitRepository
{
    public function incrementVisit($countryCode): void;

    public function getStatistics(): array;
}
