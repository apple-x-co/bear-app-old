<?php
declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use AppCore\Domain\Model\User\UserQueryInterface;
use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\RepositoryModule\Annotation\Purge;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Ray\Query\Annotation\Query;

/**
 * Class User
 * @package MyVendor\MyProject\Resource\App
 */
class User extends ResourceObject
{
    /** @var UserQueryInterface */
    private $userQuery;

    /**
     * User constructor.
     *
     * @param UserQueryInterface $userQuery
     */
    public function __construct(UserQueryInterface $userQuery)
    {
        $this->userQuery = $userQuery;
    }

    /**
     * @param int $id
     *
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json")
     */
    public function onGet(int $id): ResourceObject
    {
        $user = $this->userQuery->get($id);

        $this->body = [
            'id'       => $user->getId()->val(),
            'username' => $user->getUserName()->val(),
            'email'    => $user->getEmail()->val()
        ];

        return $this;
    }

    /**
     * @param int $id
     *
     * @return ResourceObject
     *
     * @Purge(uri="app://self/user")
     */
    public function onDelete(int $id) : ResourceObject
    {
        $this->userQuery->delete($id);

        return $this;
    }
}