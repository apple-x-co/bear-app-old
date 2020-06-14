<?php
declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
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
 */
class Users extends ResourceObject
{
    /** @var UserQueryInterface */
    private $userQuery;

    /**
     * Users constructor.
     *
     * @param UserQueryInterface $userQuery
     */
    public function __construct(UserQueryInterface $userQuery)
    {
        $this->userQuery = $userQuery;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="users.json")
     */
    public function onGet(): ResourceObject
    {
        $users = $this->userQuery->all();

        $array = [];
        foreach ($users as $user) {
            $array[] = [
                'id'       => $user->getId()->val(),
                'username' => $user->getUserName()->val(),
                'email'    => $user->getEmail()->val()
            ];
        }

        $this->body = ['users' => $array];

        return $this;
    }

    /**
     * @param string $username
     * @param string $email
     *
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json", params="users.json")
     * @Transactional()
     * @Purge(uri="app://self/users")
     */
    public function onPost(
        string $username,
        string $email
    ): ResourceObject {
        $this->userQuery->store(
            new \AppCore\Domain\Model\User\User(
                null,
                new UserName($username),
                new Email($email)
            )
        );

        $this->code = StatusCode::CREATED;
        //$this->headers[ResponseHeader::LOCATION] = '/users/1';

        return $this;
    }
}