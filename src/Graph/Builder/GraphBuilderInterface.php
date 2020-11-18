<?php

namespace Nscps\Ds\Graph\Builder;

use Nscps\Ds\Graph\GraphInterface;

interface GraphBuilderInterface
{

//    public function getEdges(): EdgeInterface[];
//    public function setEdges(array $edges): GraphBuilderInterface;
//    public function hasEdge(EdgeInterface $edge): bool;
//    public function addEdge(EdgeInterface $edge): GraphBuilderInterface;
//    public function removeEdge(EdgeInterface $edge): GraphBuilderInterface;
//
//    public function getNodes(): NodeInterface[];
//    public function setNodes(array $nodes): GraphBuilderInterface;
//    public function hasNode(NodeInterface $node): bool;
//    public function addNode(NodeInterface $node): GraphBuilderInterface;
//    public function removeNode(NodeInterface $node): GraphBuilderInterface;

    public function getAdjList(): GraphInterface;
    public function getAdjMatrix(): GraphInterface;

}