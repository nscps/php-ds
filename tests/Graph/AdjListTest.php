<?php

namespace Nscps\Ds\Tests\Graph;

use Nscps\Ds\Graph\AdjList;
use Nscps\Ds\Graph\Edge;
use Nscps\Ds\Graph\Node;
use Nscps\Ds\Tests\AbstractTestCase;

class AdjListTest extends AbstractTestCase
{

    use GraphProvidersTrait;

    /**
     * @test
     * @dataProvider validGraphProvider
     * @param array $arr
     */
    public function testConstruct(array $arr)
    {
        $adjList = new AdjList($arr['nodes'], $arr['edges']);

        $nodes = $adjList->getNodes();
        $edges = $adjList->getEdges();

        $this->assertIsArray($nodes);
        foreach ($nodes as $node) {
            $this->assertInstanceOf(Node::class, $node);
        }

        $this->assertIsArray($edges);
        foreach ($edges as $edge) {
            $this->assertInstanceOf(Edge::class, $edge);
        }

        $this->assertCount($arr['nbNodes'], $nodes);
        $this->assertEquals($arr['nbNodes'], $adjList->getNumberOfNodes());

        $this->assertCount($arr['nbEdges'], $edges);
        $this->assertEquals($arr['nbEdges'], $adjList->getNumberOfEdges());
    }

    /**
     * @test
     * @dataProvider validNotEmptyGraphProvider
     * @param array $arr
     */
    public function testGetIndegree(array $arr)
    {
        $adjList = new AdjList($arr['nodes'], $arr['edges']);

        $nodes = $adjList->getNodes();

        foreach ($nodes as $node) {
            $expected = $arr['indegree'][$node->getId()];

            $this->assertEquals($expected, $adjList->getIndegree($node));
        }
    }

    /**
     * @test
     * @dataProvider validNotEmptyGraphProvider
     * @param array $arr
     */
    public function testGetOutegree(array $arr)
    {
        $adjList = new AdjList($arr['nodes'], $arr['edges']);

        $nodes = $adjList->getNodes();

        foreach ($nodes as $node) {
            $expected = $arr['outdegree'][$node->getId()];

            $this->assertEquals($expected, $adjList->getOutDegree($node));
        }
    }

}