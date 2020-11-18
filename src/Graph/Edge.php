<?php

namespace Nscps\Ds\Graph;

class Edge implements EdgeInterface
{

    /**
     * @var NodeInterface
     */
    private NodeInterface $from;

    /**
     * @var NodeInterface
     */
    private NodeInterface $to;

    /**
     * @var int|mixed
     */
    private $weight;

    /**
     * Edge constructor.
     * @param NodeInterface $from
     * @param NodeInterface $to
     * @param mixed $weight
     */
    public function __construct(NodeInterface $from, NodeInterface $to, $weight)
    {
        $this->from = $from;
        $this->to = $to;
        $this->weight = $weight;
    }

    /**
     * @inheritDoc
     */
    public function getFrom(): NodeInterface
    {
        return $this->from;
    }

    /**
     * @inheritDoc
     */
    public function getTo(): NodeInterface
    {
        return $this->to;
    }

    /**
     * @inheritDoc
     */
    public function getWeight()
    {
        return $this->weight;
    }

}