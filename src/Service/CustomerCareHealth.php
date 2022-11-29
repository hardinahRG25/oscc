<?php

namespace App\Service;

class CustomerCareHealth
{

    private int $custRelation;
    private int $business;
    private int $custBackup;
    private int $employeeBackup;

    public function __construct()
    {
        $this->custRelation = 1;
        $this->business = 2;
        $this->custBackup = 4;
        $this->employeeBackup = 3;
    }

    public function averageScore(
        float $customerRelation,
        float $business,
        float $customerBackup,
        float $employeeBackup
    ): ?float {

        return ($customerRelation * $this->custRelation + $business * $this->business + $customerBackup * $this->custBackup + $employeeBackup * $this->employeeBackup) / 10;
    }
}
