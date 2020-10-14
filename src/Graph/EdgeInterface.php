<?php

namespace Nscps\Ds\Graph;

interface EdgeInterface
{

    /**
     * @return NodeInterface
     */
    public function getFrom(): NodeInterface;

    /**
     * @return NodeInterface
     */
    public function getTo(): NodeInterface;

    /**
     * @return mixed
     */
    public function getWeight();

}