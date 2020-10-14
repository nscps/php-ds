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
     * Return the in degree of a node U (number of incoming edges).
     * @param NodeInterface $u
     * @return int
     */
    public function getIndegree(NodeInterface $u): int;

    /**
     * Test if a node has incoming edges.
     * @param NodeInterface $u
     * @return bool
     */
    public function hasIncomingEdges(NodeInterface $u): bool;

    /**
     * List all edges going to node U.
     * @param NodeInterface $u
     * @return EdgeInterface[]
     */
    public function getIncomingEdges(NodeInterface $u): array;

    /**
     * Return the out degree" of a node U (number of outgoing edges).
     * @param NodeInterface $u
     * @return int
     */
    public function getOutDegree(NodeInterface $u): int;

    /**
     * Test if a node has outgoing edges.
     * @param NodeInterface $u
     * @return bool
     */
    public function hasOutgoingEdges(NodeInterface $u): bool;

    /**
     * List all edges going out from node U.
     * @param NodeInterface $u
     * @return array
     */
    public function getOutgoingEdges(NodeInterface $u): array;

    /**
     * List all nodes V such that there is an edge between U and V.
     * @param NodeInterface $u
     * @return NodeInterface[]
     */
    public function getNeighbors(NodeInterface $u): array;

    /**
     * Test if there is an edge from node U to the node V.
     * @param NodeInterface $u
     * @param NodeInterface $v
     * @return bool
     */
    public function isAdjacent(NodeInterface $u, NodeInterface $v): bool;

}