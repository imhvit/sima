<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    public function __construct(
        private readonly DashboardRepository $dashboardRepo
    ) {}

    public function getData(): array
    {
        return [
            "totalProducts" =>  $this->dashboardRepo->totalProducts(),
            "totalWarehouses" =>  $this->dashboardRepo->totalWarehouses(),
            "totalInventoryValue" => $this->dashboardRepo->totalInventoryValue(),
        ];
    }
}
