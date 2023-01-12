<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Conversion
{
    /**
     * @var int
     */
    private $maxMonth;
    /**
     * @var string
     */
    private $days;
    /**
     * @var string
     */
    private $month;
    /**
     * @var string
     */
    private $years;

    public function __construct()
    {
        $this->maxMonth = 12;
        $this->days = "jours";
        $this->month = "mois";
        $this->years = "année(s)";
    }

    /**
     * @param string $value
     * @return string|null
     */
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

    /**
     * @param string $gender
     * @return string|null
     */
    public function genderString(string $gender): ?string
    {
        if ($gender === 'f') {
            return 'Féminin';
        }
        return 'Masculin';
    }
}
