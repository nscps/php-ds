<?php

namespace Nscps\Ds\Tests\Docs\BrDocs;

use Nscps\Ds\Docs\BrDocs\Pis;
use Nscps\Ds\Tests\AbstractTestCase;

class PisTest extends AbstractTestCase
{

    /**
     * @return array
     */
    public function invalidPatternProvider()
    {
        return [
            [''],
            ['abc.defgh.ij-k'],
            ['000.00000.00.0'],
            ['111-11111-11-1'],
            ['222x22222x22-2'],
            ['333 33333 33 3'],
            ['444 44444 44-4'],
        ];
    }

    /**
     * @return array
     */
    public function invalidPisProvider()
    {
        return [
            // 000.00000.00-0 is invalid
            ['000.00000.00-0'],

            // d1 is invalid
            ['660.42017.23-1'],
            ['682.04391.59-8'],
            ['155.62723.52-7'],
            ['711.97067.90-3'],
            ['895.24567.93-2'],
            ['915.92550.49-5'],
        ];
    }

    /**
     * @return array
     */
    public function validPisProvider()
    {
        return [
            ['660.42017.23-0'],
            ['682.04391.59-7'],
            ['155.62723.52-6'],
            ['711.97067.90-4'],
            ['895.24567.93-1'],
            ['915.92550.49-8'],
        ];
    }

    /**
     * @test
     * @dataProvider invalidPatternProvider
     * @param string $str
     */
    public function shouldThrowExceptionWhenThePatternIsInvalid($str)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The PIS must contain 11 digits or match the following pattern: "999.99999.99-9".');

        $pis = new Pis($str);
    }

    /**
     * @test
     * @dataProvider invalidPisProvider
     * @param string $str
     */
    public function shouldThrowExceptionWhenThePisIsInvalid($str)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid PIS.');

        $pis = new Pis($str);
    }

    /**
     * @test
     * @dataProvider validPisProvider
     * @param string $str
     */
    public function testToString($str)
    {
        $pis = new Pis($str);

        $this->assertEquals($str, (string) $pis);
    }

    /**
     * @test
     * @dataProvider validPisProvider
     * @param string $str
     */
    public function testGetRaw($str)
    {
        $pis = new Pis($str);

        $expected = preg_replace('/[^0-9]/', '', $str);

        $this->assertEquals($expected, $pis->getRaw());
    }

    /**
     * @test
     * @dataProvider validPisProvider
     * @param string $str
     */
    public function testGetPis($str)
    {
        $pis = new Pis($str);

        $this->assertEquals($str, $pis->getPis());
    }

}