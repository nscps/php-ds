<?php

namespace Nscps\Ds\Tests\Docs\BrDocs;

use Nscps\Ds\Docs\BrDocs\Cnpj;
use Nscps\Ds\Tests\AbstractTestCase;

class CnpjTest extends AbstractTestCase
{

    /**
     * @return array
     */
    public function invalidPatternProvider()
    {
        return [
            [''],
            ['ab.cde.fgh\ijkl-mn'],
            ['00.000.000.0000.00'],
            ['11-111-111-1111-11'],
            ['22x222x222x2222x22'],
            ['33 333 333 3333 33'],
        ];
    }

    /**
     * @return array
     */
    public function invalidCnpjProvider()
    {
        return [
            // 00.000.000/0000-00 is invalid
            ['00.000.000/0000-00'],

            // d1 is invalid
            ['71.992.835/0001-03'],
            ['89.908.274/0001-07'],

            // d2 is invalid
            ['71.992.835/0001-14'],
            ['89.908.274/0001-98'],

            // d1 and d2 are invalid
            ['71.992.835/0001-26'],
            ['89.908.274/0001-54'],
        ];
    }

    /**
     * @return array
     */
    public function validCnpjProvider()
    {
        return [
            ['71.992.835/0001-13'],
            ['89.908.274/0001-97'],
            ['30.989.663/0001-41'],
            ['00.653.867/0001-46'],
            ['77.818.679/0001-55'],
            ['96.163.311/0001-40'],
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
        $this->expectExceptionMessage('The CNPJ must contain 14 digits or match the following pattern: "99.999.999/9999-99".');

        $cnpj = new Cnpj($str);
    }

    /**
     * @test
     * @dataProvider invalidCnpjProvider
     * @param string $str
     */
    public function shouldThrowExceptionWhenTheCnpjIsInvalid($str)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid CNPJ.');

        $cnpj = new Cnpj($str);
    }

    /**
     * @test
     * @dataProvider validCnpjProvider
     * @param string $str
     */
    public function testToString($str)
    {
        $cnpj = new Cnpj($str);

        $this->assertEquals($str, (string) $cnpj);
    }

    /**
     * @test
     * @dataProvider validCnpjProvider
     * @param string $str
     */
    public function testGetRaw($str)
    {
        $cnpj = new Cnpj($str);

        $expected = preg_replace('/[^0-9]/', '', $str);

        $this->assertEquals($expected, $cnpj->getRaw());
    }

    /**
     * @test
     * @dataProvider validCnpjProvider
     * @param string $str
     */
    public function testGetCnpj($str)
    {
        $cnpj = new Cnpj($str);

        $this->assertEquals($str, $cnpj->getCnpj());
    }

}