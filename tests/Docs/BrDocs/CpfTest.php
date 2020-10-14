<?php

namespace Nscps\Ds\Tests\Docs\BrDocs;

use Nscps\Ds\Docs\BrDocs\Cpf;
use Nscps\Ds\Tests\AbstractTestCase;

class CpfTest extends AbstractTestCase
{

    /**
     * @return array
     */
    public function invalidPatternProvider()
    {
        return [
            [''],
            ['abc.def.ghi-jk'],
            ['000.000.000.00'],
            ['111-111-111-11'],
            ['222x222x222x22'],
            ['333 333 333 33'],
        ];
    }

    /**
     * @return array
     */
    public function invalidCpfProvider()
    {
        return [
            // 000.000.000-00, ..., 999.999.999-99 are invalid.
            ['000.000.000-00'],
            ['111.111.111-11'],
            ['222.222.222-22'],
            ['333.333.333-33'],
            ['444.444.444-44'],
            ['555.555.555-55'],
            ['666.666.666-66'],
            ['777.777.777-77'],
            ['888.888.888-88'],
            ['999.999.999-99'],

            // d1 is invalid
            ['484.546.920-12'],
            ['572.933.420-13'],

            // d2 is invalid
            ['484.546.920-00'],
            ['484.546.920-01'],
            ['572.933.420-62'],
            ['572.933.420-64'],

            // d1 and d2 are invalid
            ['484.546.920-13'],
            ['572.933.420-74'],
        ];
    }

    /**
     * @return array
     */
    public function validCpfProvider()
    {
        return [
            ['484.546.920-02'],
            ['572.933.420-63'],
            ['114.484.530-03'],
            ['957.208.010-57'],
            ['580.320.780-29'],
            ['586.567.070-00'],
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
        $this->expectExceptionMessage('The CPF must contains 11 digits or match the following pattern: "999.999.999-99".');

        $cpf = new Cpf($str);
    }

    /**
     * @test
     * @dataProvider invalidCpfProvider
     * @param string $str
     */
    public function shouldThrowExceptionWhenTheCpfIsInvalid($str)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid CPF.');

        $cpf = new Cpf($str);
    }

    /**
     * @test
     * @dataProvider validCpfProvider
     * @param string $str
     */
    public function testToString($str)
    {
        $cpf = new Cpf($str);

        $this->assertEquals($str, (string) $cpf);
    }

    /**
     * @test
     * @dataProvider validCpfProvider
     * @param string $str
     */
    public function testGetRaw($str)
    {
        $cpf = new Cpf($str);

        $expected = preg_replace('/[^0-9]/', '', $str);

        $this->assertEquals($expected, $cpf->getRaw());
    }

    /**
     * @test
     * @dataProvider validCpfProvider
     * @param string $str
     */
    public function testGetCpf($str)
    {
        $cpf = new Cpf($str);

        $this->assertEquals($str, $cpf->getCpf());
    }

}