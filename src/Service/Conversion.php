<?php

namespace App\Service;

class Conversion
{
    private int $maxMonth;
    private string $days;
    private string $month;
    private string $years;

    public function __construct()
    {
        $this->maxMonth = 12;
        $this->days = "jours";
        $this->month = "mois";
        $this->years = "année(s)";
    }

    public function conversionMonthYear(string $value): ?string
    {
        if (intval($value) > 12) {
            $year = floor($value / 12);
            $month = floor(($value - ($year * 12)));
            return sprintf('%s ' . $this->years . 'et %s ' . $this->month, $year, $month);
        } else {
            return sprintf('%s ' . $this->month, $value);
        }
    }
}
