<?php

namespace Nscps\Ds\Tests\Arrays;

use Nscps\Ds\Arrays\AssocArray;
use Nscps\Ds\Tests\AbstractTestCase;

class AssocArrayTest extends AbstractTestCase
{

    use ArrayProvidersTrait;

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testHas(array $arr)
    {
        $mdArray = new AssocArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertTrue($mdArray->has($key));
        }

        $this->assertFalse($mdArray->has('invalid_key'));
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testGet(array $arr)
    {
        $mdArray = new AssocArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertEquals($value, $mdArray->get($key));
        }

        $this->assertNull($mdArray->get('invalid_key'));
        $this->assertFalse($mdArray->get('invalid_key', false));
        $this->assertEquals(123, $mdArray->get('invalid_key', 123));
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testSet(array $arr)
    {
        $mdArray = new AssocArray($arr['array']);

        $this->assertFalse($mdArray->has('four'));

        $this->assertSame($mdArray, $mdArray->set('four', 4));

        $this->assertTrue($mdArray->has('four'));

        $this->assertEquals(4, $mdArray->get('four'));
    }

}