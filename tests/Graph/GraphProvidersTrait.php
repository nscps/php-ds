<?php

namespace Nscps\Ds\Tests\Graph;

use Nscps\Ds\Graph\Edge;
use Nscps\Ds\Graph\Node;

trait GraphProvidersTrait
{

    /**
     * @return array
     */
    public function validGraphProvider()
    {
        // Empty
        $empty = [
            'nodes' => [],
            'indegree' => [],
            'outdegree' => [],
            'edges' => [],
            'nbNodes' => 0,
            'nbEdges' => 0,
        ];

        // One node
        $singleNode = [
            'nodes' => [
                new Node('a'),
            ],
            'indegree' => [
                'a' => 0,
            ],
            'outdegree' => [
                'a' => 0,
            ],
            'edges' => [],
            'nbNodes' => 1,
            'nbEdges' => 0,
        ];

        // Two nodes, 0 edges
        $twoNodes = [
            'nodes' => [
                new Node('a'),
                new Node('b'),
            ],
            'indegree' => [
                'a' => 0,
                'b' => 0,
            ],
            'outdegree' => [
                'a' => 0,
                'b' => 0,
            ],
            'edges' => [],
            'nbNodes' => 2,
            'nbEdges' => 0,
        ];

        // Two connected nodes
        $twoNodesA = new Node('a');
        $twoNodesB = new Node('b');
        $twoConnectedNodes = [
            'nodes' => [
                $twoNodesA,
                $twoNodesB,
            ],
            'indegree' => [
                'a' => 0,
                'b' => 1,
            ],
            'outdegree' => [
                'a' => 1,
                'b' => 0,
            ],
            'edges' => [
                new Edge($twoNodesA, $twoNodesB, 1)
            ],
            'nbNodes' => 2,
            'nbEdges' => 1,
        ];

        // Full graph
        $fullGraphA = new Node('a');
        $fullGraphB = new Node('b');
        $fullGraphC = new Node('c');
        $fullGraphD = new Node('d');
        $fullGraph = [
            'nodes' => [
                $fullGraphA,
                $fullGraphB,
                $fullGraphC,
                $fullGraphD,
            ],
            'indegree' => [
                'a' => 3,
                'b' => 3,
                'c' => 3,
                'd' => 3,
            ],
            'outdegree' => [
                'a' => 3,
                'b' => 3,
                'c' => 3,
                'd' => 3,
            ],
            'edges' => [
                new Edge($fullGraphA, $twoNodesB, 0),
                new Edge($fullGraphA, $fullGraphC, 0),
                new Edge($fullGraphA, $fullGraphD, 0),
                new Edge($twoNodesB, $fullGraphA, 0),
                new Edge($twoNodesB, $fullGraphC, 0),
                new Edge($twoNodesB, $fullGraphD, 0),
                new Edge($fullGraphC, $fullGraphA, 0),
                new Edge($fullGraphC, $twoNodesB, 0),
                new Edge($fullGraphC, $fullGraphD, 0),
                new Edge($fullGraphD, $fullGraphA, 0),
                new Edge($fullGraphD, $twoNodesB, 0),
                new Edge($fullGraphD, $fullGraphC, 0),
            ],
            'nbNodes' => 4,
            'nbEdges' => 12,
        ];

        return [
            [$empty],
            [$singleNode],
            [$twoNodes],
            [$twoConnectedNodes],
            [$fullGraph],
        ];
    }

    /**
     * @return array
     */
    public function validNotEmptyGraphProvider()
    {
        $graphs = [];

        foreach ($this->validGraphProvider() as $params) {
            $graph = $params[0];

            if (count($graph['nodes']) > 0) {
                $graphs[] = $params;
            }
        }

        return $graphs;
    }

}