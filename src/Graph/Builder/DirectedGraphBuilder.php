<?php

namespace Nscps\Ds\Graph\Builder;

use Nscps\Ds\Graph\AdjList;
use Nscps\Ds\Graph\AdjMatrix;
use Nscps\Ds\Graph\Edge;
use Nscps\Ds\Graph\Node;

class DirectedGraphBuilder implements GraphBuilderInterface
{

    /**
     * @var Edge[]
     */
    protected array $edges = [];

    /**
     * @var Node[]
     */
    protected array $nodes = [];

    /**
     * @var string
     */
    protected string $type = 'directed';

    /**
     * @return Edge[]
     */
    public function getEdges(): array
    {
        return $this->edges;
    }

    /**
     * @param Edge[] $edges
     * @return GraphBuilder
     */
    public function setEdges(array $edges): GraphBuilder
    {
        $this->edges = [];
        foreach ($edges as $edge) {
            $this->addEdge($edge);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @param Node[] $nodes
     * @return GraphBuilder
     */
    public function setNodes(array $nodes): GraphBuilder
    {
        $this->nodes = [];
        foreach ($nodes as $node) {
            $this->addNode($node);
        }
        return $this;
    }

    /**
     * @param string $node
     * @return bool
     */
    public function hasNode($node): bool
    {
        return array_key_exists($node, $this->nodes);
    }

    /**
     * @param $node
     * @return $this
     */
    public function addNode($node): GraphBuilder
    {
        if (!$this->hasNode($node)) {
            $this->nodes[$node] = new Node($node);
        }
        return $this;
    }

    /**
     * @param mixed $node
     * @return $this
     */
    public function removeNode($node): GraphBuilder
    {
        if ($this->hasNode($node)) {
            unset($this->nodes[$node]);
        }
        return $this;
    }

    /**
     * @return AdjList
     */
    public function createAdjList(): AdjList
    {
        return new AdjList($this->nodes, $this->edges);
    }

    /**
     * @return AdjMatrix
     */
    public function createAdjMatrix(): AdjMatrix
    {
        return new AdjMatrix($this->nodes, $this->edges);
    }

}