<?php

namespace Nscps\Ds\Graph;

class AdjList extends AbstractGraph
{

    /**
     * @var EdgeInterface[][]
     */
    private array $adjList;

    /**
     * AdjList constructor.
     * @param NodeInterface[] $nodes
     * @param EdgeInterface[] $edges
     */
    public function __construct(array $nodes, array $edges)
    {
        parent::__construct($nodes, $edges);

        $this->adjList = [];

        foreach ($nodes as $node) {
            $this->adjList[$node->getId()] = [];
        }

        foreach ($edges as $edge) {
            $this->adjList[$edge->getFrom()->getId()][] = $edge;
        }
    }

    /**
     * @inheritDoc
     */
    public function getIncomingEdges(NodeInterface $u): array
    {
        $edges = [];

        foreach ($this->edges as $edge) {
            if ($edge->getTo()->getId() === $u->getId()) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }

    /**
     * @inheritDoc
     */
    public function getOutgoingEdges(NodeInterface $u): array
    {
        return $this->adjList[$u->getId()];
    }

    /**
     * @inheritDoc
     */
    public function getNeighbors(NodeInterface $u): array
    {
        $neighbors = [];

        foreach ($this->getOutgoingEdges($u) as $edge) {
            $neighbors[] = $edge->getTo();
        }

        return array_unique($neighbors);
    }

    /**
     * @param NodeInterface $u
     * @param NodeInterface $v
     * @return bool
     */
    public function isAdjacent(NodeInterface $u, NodeInterface $v): bool
    {
        foreach ($this->getOutgoingEdges($u) as $edge) {
            if ($edge->getTo()->getId() === $v->getId()) {
                return true;
            }
        }
        return false;
    }

}