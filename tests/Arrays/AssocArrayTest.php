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
        $arrObj = new AssocArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertTrue($arrObj->has($key));
        }

        $this->assertFalse($arrObj->has('invalid_key'));
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testGet(array $arr)
    {
        $arrObj = new AssocArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertEquals($value, $arrObj->get($key));
        }

        $this->assertNull($arrObj->get('invalid_key'));
        $this->assertFalse($arrObj->get('invalid_key', false));
        $this->assertEquals(123, $arrObj->get('invalid_key', 123));
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testSet(array $arr)
    {
        $arrObj = new AssocArray($arr['array']);

        $this->assertFalse($arrObj->has('four'));

        $this->assertSame($arrObj, $arrObj->set('four', 4));

        $this->assertTrue($arrObj->has('four'));

        $this->assertEquals(4, $arrObj->get('four'));
    }

}