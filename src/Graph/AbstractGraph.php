<?php

namespace Nscps\Ds\Graph;

abstract class AbstractGraph implements GraphInterface
{

    /**
     * @var NodeInterface[]
     */
    protected array $nodes;

    /**
     * @var int
     */
    protected int $nbNodes;

    /**
     * @var EdgeInterface[]
     */
    protected array $edges;

    /**
     * @var int
     */
    protected int $nbEdges;

    /**
     * AbstractGraph constructor.
     * @param NodeInterface[] $nodes
     * @param EdgeInterface[] $edges
     */
    public function __construct(array $nodes, array $edges)
    {
        $this->nodes = $nodes;
        $this->edges = $edges;

        $this->nbNodes = count($nodes);
        $this->nbEdges = count($edges);
    }

    /**
     * @inheritDoc
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @inheritDoc
     */
    public function getEdges(): array
    {
        return $this->edges;
    }

    /**
     * @inheritDoc
     */
    public function getIndegree(NodeInterface $u): int
    {
        return count($this->getIncomingEdges($u));
    }

    /**
     * @inheritDoc
     */
    public function hasIncomingEdges(NodeInterface $u): bool
    {
        return $this->getIndegree($u) > 0;
    }

    /**
     * @inheritDoc
     */
    public function getOutDegree(NodeInterface $u): int
    {
        return count($this->getOutgoingEdges($u));
    }

    /**
     * @inheritDoc
     */
    public function hasOutgoingEdges(NodeInterface $u): bool
    {
        return $this->getOutDegree($u) > 0;
    }

}