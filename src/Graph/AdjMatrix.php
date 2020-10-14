<?php

namespace Nscps\Ds\Graph;

class AdjMatrix extends AbstractGraph
{

    /**
     * @var Edge[][]
     */
    private array $adjMatrix;

    /**
     * AdjMatrix constructor.
     * @param NodeInterface[] $nodes
     * @param EdgeInterface[] $edges
     */
    public function __construct(array $nodes, array $edges)
    {
        parent::__construct($nodes, $edges);

        for ($i = 0; $i < $this->nbNodes; $i++) {
            $i_id = $nodes[$i]->getId();

            $this->adjMatrix[$i_id] = [];

            for ($j = 0; $j < $this->nbNodes; $j++) {
                $j_id = $nodes[$j]->getId();
                $this->adjMatrix[$i_id][$j_id] = null;
            }
        }

        foreach ($edges as $edge) {
            $i_id = $edge->getFrom()->getId();
            $j_id = $edge->getTo()->getId();

            $this->adjMatrix[$i_id][$j_id] = $edge;
        }
    }

    /**
     * @inheritDoc
     */
    public function getIncomingEdges(NodeInterface $u): array
    {
        $edges = [];

        foreach ($this->nodes as $v) {
            $edge = $this->adjMatrix[$v->getId()][$u->getId()];
            if ($edge instanceof EdgeInterface) {
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
        $edges = [];

        foreach ($this->nodes as $v) {
            $edge = $this->adjMatrix[$u->getId()][$v->getId()];
            if ($edge instanceof EdgeInterface) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }

    /**
     * @inheritDoc
     */
    public function getNeighbors(NodeInterface $u): array
    {
        $neighbors = [];

        foreach ($this->nodes as $v) {
            $edge = $this->adjMatrix[$u->getId()][$v->getId()];
            if ($edge instanceof EdgeInterface) {
                $neighbors[] = $edge->getTo();
            }
        }

        return $neighbors;
    }

    /**
     * @inheritDoc
     */
    public function isAdjacent(NodeInterface $u, NodeInterface $v): bool
    {
        $u_id = $u->getId();
        $v_id = $v->getId();

        return $this->adjMatrix[$u_id][$v_id] instanceof EdgeInterface;
    }

}