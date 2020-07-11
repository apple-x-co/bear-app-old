<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public function onGet(): ResourceObject
    {
        return $this;
    }
}
