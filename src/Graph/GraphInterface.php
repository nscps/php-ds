<?php

namespace Nscps\Ds\Graph;

interface GraphInterface
{

    /**
     * Return all the nodes of the graph.
     * @return NodeInterface[]
     */
    public function getNodes(): array;

    /**
     * Return all the edges of the graph.
     * @return EdgeInterface[]
     */
    public function getEdges(): array;

    /**
     * Return the indegree of a node (number of incoming edges).
     * @param NodeInterface $node
     * @return int
     */
    public function getIndegree(NodeInterface $node): int;

    /**
     * Test if a node has incoming edges.
     * @param NodeInterface $node
     * @return bool
     */
    public function hasIncomingEdges(NodeInterface $node): bool;

    /**
     * List all edges going to node A.
     * @param NodeInterface $node
     * @return EdgeInterface[]
     */
    public function getIncomingEdges(NodeInterface $node): array;

    /**
     * Return the outdegree of a node (number of outgoing edges).
     * @param NodeInterface $node
     * @return int
     */
    public function getOutDegree(NodeInterface $node): int;

    /**
     * Test if a node has outgoing edges.
     * @param NodeInterface $node
     * @return bool
     */
    public function hasOutgoingEdges(NodeInterface $node): bool;

    /**
     * List all edges going out from node A.
     * @param NodeInterface $node
     * @return array
     */
    public function getOutgoingEdges(NodeInterface $node): array;

    /**
     * List all nodes B such that there is an edge between A and B.
     * @param NodeInterface $node
     * @return NodeInterface[]
     */
    public function getNeighbors(NodeInterface $node): array;

    /**
     * Test if there is an edge from node A to the node B,
     * @param NodeInterface $a
     * @param NodeInterface $b
     * @return bool
     */
    public function isAdjacent(NodeInterface $a, NodeInterface $b): bool;

}