<?php

namespace Nscps\Ds\Tests\Graph;

use Nscps\Ds\Graph\Node;
use Nscps\Ds\Tests\AbstractTestCase;

class NodeTest extends AbstractTestCase
{

    /**
     * @return array
     */
    public function validNodeProvider()
    {
        $nodes = [];

        $nodes[] = [['id' => 1]];

        $nodes[] = [['id' => 'a']];

        $nodes[] = [['id' => 'abc']];

        return $nodes;
    }

    /**
     * @test
     * @dataProvider validNodeProvider
     * @param array $arr
     */
    public function testConstruct(array $arr)
    {
        $node = new Node($arr['id']);

        $this->assertEquals($arr['id'], $node->getId());
    }

}