<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Generate
{
    public function __construct()
    {
    }

    public function generateNumber(string $country, int $sizeNumber)
    {
        switch ($country) {
            case 'fr':
                $phoneIndex = "33";
                break;
            case 'mg':
                $phoneIndex = "261";

            default:
                break;
        }
        $phone = '+' . $phoneIndex . ' ';
        for ($i = 0; $i < $sizeNumber; $i++) {
            $maxnumber = 9;
            $phone .= mt_rand(0, $maxnumber);
        }
        return $phone;
    }
}
