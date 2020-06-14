<?php
declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use BEAR\Package\Annotation\ReturnCreatedResource;
use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\RepositoryModule\Annotation\Purge;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Ray\AuraSqlModule\Annotation\Transactional;
use Ray\Di\Di\Named;
use Ray\Query\Annotation\Query;

/**
 * Class Users
 * @package MyVendor\MyProject\Resource\App
 *
 * @Cacheable()
 */
class Users extends ResourceObject
{
    /** @var callable */
    private $createUser;

    /**
     * Users constructor.
     *
     * @param callable $createUser
     *
     * @Named("createUser=user_insert")
     */
    public function __construct(callable $createUser)
    {
        $this->createUser = $createUser;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="users.json")
     * @Query("users_list")
     */
    public function onGet(): ResourceObject
    {
        $users = $this->body;
        $this->body = ['users' => $users];

        return $this;
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     *
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json", params="users.json")
     * ReturnCreatedResource()
     * @Transactional()
     * @Purge(uri="app://self/users")
     */
    public function onPost(
        string $username,
        string $email,
        string $password
    ): ResourceObject {
        ($this->createUser)([
            'username' => $username,
            'email'    => $email,
            'password' => $password
        ]);

        $this->code = StatusCode::CREATED;
        //$this->headers[ResponseHeader::LOCATION] = '/users/1';

        return $this;
    }
}