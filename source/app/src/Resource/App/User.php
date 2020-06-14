<?php
declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Ray\Query\Annotation\Query;

/**
 * Class User
 * @package MyVendor\MyProject\Resource\App
 *
 * @Cacheable()
 */
class User extends ResourceObject
{
    /**
     * @param int $id
     *
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json")
     * @Query("user_by_id", type="row")
     */
    public function onGet(int $id) : ResourceObject
    {
        return $this;
    }
}