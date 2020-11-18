<?php

namespace Nscps\Ds\Tests\Graph;

use Nscps\Ds\Graph\Edge;
use Nscps\Ds\Graph\Node;
use Nscps\Ds\Tests\AbstractTestCase;

class EdgeTest extends AbstractTestCase
{

    /**
     * @return array
     */
    public function validEdgeProvider()
    {
        $nodes = [];

        $nodes[] = [[
            'from' => new Node('a'),
            'to' => new Node('b'),
            'weight' => -1,
        ]];

        $nodes[] = [[
            'from' => new Node('b'),
            'to' => new Node('a'),
            'weight' => 0,
        ]];

        $nodes[] = [[
            'from' => new Node(1),
            'to' => new Node(2),
            'weight' => 1,
        ]];

        return $nodes;
    }

    /**
     * @test
     * @dataProvider validEdgeProvider
     * @param array $arr
     */
    public function testConstruct(array $arr)
    {
        $node = new Edge($arr['from'], $arr['to'], $arr['weight']);

        $this->assertSame($arr['from'], $node->getFrom());
        $this->assertSame($arr['to'], $node->getTo());
        $this->assertEquals($arr['weight'], $node->getWeight());
    }

}