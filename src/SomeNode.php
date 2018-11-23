<?php

declare(strict_types=1);

namespace App;

class SomeNode
{
    private $somesubnode = [];

    public function getSomesubnode(): array
    {
        return $this->somesubnode;
    }

    public function setSomesubnode(array $somesubnode): void
    {
        $this->somesubnode = $somesubnode;
    }
}
