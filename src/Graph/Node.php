<?php

namespace Nscps\Ds\Graph;

class Node implements NodeInterface
{

    /**
     * @var mixed
     */
    private $id;

    /**
     * Node constructor.
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}