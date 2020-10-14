<?php

namespace Nscps\Ds\Tests\Arrays;

trait ArrayProvidersTrait
{

    /**
     * @return array
     */
    public function validAssocArraysProvider()
    {
        $empty_array = [
            'array' => [],
            'count' => 0,
        ];

        $md_array = [
            'array' => [
                'one' => 1,
                'two' => 2,
                'three' => 3,
            ],
            'count' => 3,
        ];

        return [
            [$empty_array],
            [$md_array],
        ];
    }

}