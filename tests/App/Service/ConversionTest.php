<?php

namespace App\Tests\App\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\Conversion;

class ConversionTest extends KernelTestCase
{
    public function testGenderString(): void
    {
        $convert = new Conversion(12);
        $resulat = $convert->genderString('f');
        $this->assertEquals('Féminin', $resulat);

        $resulat = $convert->genderString('m');
        $this->assertEquals('Masculin', $resulat);

        $resulat = $convert->genderString('w');
        $this->assertEquals('Masculin', $resulat);
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
