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
        $arrObj = new AssocArray($arr['array']);

        $this->assertEquals($arr['array'], $arrObj->getArray());
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testSetAndGetData(array $arr)
    {
        $arrObj = new AssocArray();

        $this->assertSame($arrObj, $arrObj->setArray($arr['array']));

        $this->assertEquals($arr['array'], $arrObj->getArray());
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testContains(array $arr)
    {
        $arrObj = new AssocArray($arr['array']);

        foreach ($arr['array'] as $key => $value) {
            $this->assertTrue($arrObj->contains($value));
        }

        $this->assertFalse($arrObj->contains('invalid-value'));
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testCount(array $arr)
    {
        $arrObj = new AssocArray($arr['array']);

        $this->assertCount($arr['count'], $arrObj);
    }

    /**
     * @test
     * @dataProvider validAssocArraysProvider
     * @param array $arr
     */
    public function testGetIterator(array $arr)
    {
        $arrObj = new AssocArray($arr['array']);

        $this->assertInstanceOf(\ArrayIterator::class, $arrObj->getIterator());

        foreach ($arrObj as $key => $value) {
            $this->assertEquals($value, $arr['array'][$key]);
        }
    }

}