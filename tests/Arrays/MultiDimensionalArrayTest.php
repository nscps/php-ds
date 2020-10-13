<?php

namespace Nscps\Ds\Tests\Arrays;

use Nscps\Ds\Arrays\MultiDimensionalArray;
use Nscps\Ds\Tests\AbstractTestCase;

class MultiDimensionalArrayTest extends AbstractTestCase
{

    /**
     * @return array
     */
    public function validMultiDimensionalArraysProvider()
    {
        $empty_array = [
            'array' => [],
            'count' => 0,
        ];

        $md_array = [
            'array' => [
                'one' => 1,
                'two' => 2,
                'three' => 3,
            ],
            'count' => 3,
        ];

        return [
            [$empty_array],
            [$md_array],
        ];
    }

    /**
     * @test
     * @dataProvider validMultiDimensionalArraysProvider
     * @param array $arr
     */
    public function testConstructor(array $arr)
    {
        $mdArray = new MultiDimensionalArray($arr['array']);

        $this->assertEquals($arr['array'], $mdArray->getData());
    }

    /**
     * @test
     * @dataProvider validMultiDimensionalArraysProvider
     * @param array $arr
     */
    public function testSetAndGetData(array $arr)
    {
        $mdArray = new MultiDimensionalArray();

        $this->assertSame($mdArray, $mdArray->setData($arr['array']));

        $this->assertEquals($arr['array'], $mdArray->getData());
    }

    /**
     * @test
     * @dataProvider validMultiDimensionalArraysProvider
     * @param array $arr
     */
    public function testHas(array $arr)
    {
        $mdArray = new MultiDimensionalArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertTrue($mdArray->has($key));
        }

        $this->assertFalse($mdArray->has('invalid_key'));
    }

    /**
     * @test
     * @dataProvider validMultiDimensionalArraysProvider
     * @param array $arr
     */
    public function testGet(array $arr)
    {
        $mdArray = new MultiDimensionalArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertEquals($value, $mdArray->get($key));
        }

        $this->assertNull($mdArray->get('invalid_key'));
        $this->assertFalse($mdArray->get('invalid_key', false));
        $this->assertEquals(123, $mdArray->get('invalid_key', 123));
    }

    /**
     * @test
     * @dataProvider validMultiDimensionalArraysProvider
     * @param array $arr
     */
    public function testSet(array $arr)
    {
        $mdArray = new MultiDimensionalArray($arr['array']);

        $this->assertFalse($mdArray->has('four'));

        $this->assertSame($mdArray, $mdArray->set('four', 4));

        $this->assertTrue($mdArray->has('four'));

        $this->assertEquals(4, $mdArray->get('four'));
    }

    /**
     * @test
     * @dataProvider validMultiDimensionalArraysProvider
     * @param array $arr
     */
    public function testCount(array $arr)
    {
        $mdArray = new MultiDimensionalArray($arr['array']);

        $this->assertCount($arr['count'], $mdArray);
    }

    /**
     * @test
     * @dataProvider validMultiDimensionalArraysProvider
     * @param array $arr
     */
    public function testGetIterator(array $arr)
    {
        $mdArray = new MultiDimensionalArray($arr['array']);

        $this->assertInstanceOf(\ArrayIterator::class, $mdArray->getIterator());

        foreach ($mdArray as $key => $value) {
            $this->assertEquals($value, $arr['array'][$key]);
        }
    }

}