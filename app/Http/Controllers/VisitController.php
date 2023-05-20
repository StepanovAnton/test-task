<?php

namespace App\Http\Controllers;

use App\Services\VisitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct(private readonly VisitService $visitService)
    {
    }

    public function recordVisit(Request $request, $countryCode): JsonResponse
    {
        $this->visitService->recordVisit($countryCode);

        return response()->json();
    }

    public function getStatistics(): JsonResponse
    {
        $statistics = $this->visitService->getStatistics();

        return response()->json($statistics);
    }
}
