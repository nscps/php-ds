<?php

namespace Nscps\Ds\Tests\Arrays;

use Nscps\Ds\Arrays\AbstractArray;
use Nscps\Ds\Arrays\AssocArray;
use Nscps\Ds\Tests\AbstractTestCase;

class AbstractArrayTest extends AbstractTestCase
{

    use ArrayProvidersTrait;

    /**
     * @var AbstractArray
     */
    private AbstractArray $abstractClass;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->abstractClass = $this->getMockForAbstractClass(AbstractArray::class);
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testConstructor(array $arr)
    {
        $mdArray = new AssocArray($arr['array']);

        $this->assertEquals($arr['array'], $mdArray->getArray());
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testSetAndGetData(array $arr)
    {
        $mdArray = new AssocArray();

        $this->assertSame($mdArray, $mdArray->setArray($arr['array']));

        $this->assertEquals($arr['array'], $mdArray->getArray());
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testContains(array $arr)
    {
        $mdArray = new AssocArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertTrue($mdArray->contains($value));
        }

        $this->assertFalse($mdArray->contains('invalid-value'));
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testCount(array $arr)
    {
        $mdArray = new AssocArray($arr['array']);

        $this->assertCount($arr['count'], $mdArray);
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testGetIterator(array $arr)
    {
        $mdArray = new AssocArray($arr['array']);

        $this->assertInstanceOf(\ArrayIterator::class, $mdArray->getIterator());

        foreach ($mdArray as $key => $value) {
            $this->assertEquals($value, $arr['array'][$key]);
        }
    }

}