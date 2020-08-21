<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use AppCore\Application\User\Create\UserCreateInputData;
use AppCore\Application\User\Create\UserCreateUseCase;
use AppCore\Application\User\Get\UserListUseCase;
use AppCore\InterfaceAdapter\Presenter\User\UsersGetViewModel;
use BEAR\RepositoryModule\Annotation\Purge;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\Annotation\Link;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Ray\AuraSqlModule\Annotation\Transactional;

class Users extends ResourceObject
{
    /** @var UserCreateUseCase */
    private $userCreateUseCase;

    /** @var UserListUseCase */
    private $userListUseCase;

    public function __construct(
        UserCreateUseCase $userCreateUseCase,
        UserListUseCase $userListUseCase
    ) {
        $this->userCreateUseCase = $userCreateUseCase;
        $this->userListUseCase = $userListUseCase;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="users.json")
     * @Link(rel="create", href="/users", method="post")
     */
    public function onGet(): ResourceObject
    {
        $generator = $this->userListUseCase->handle();

        $users = [];
        foreach ($generator as $user) {
            $users[] = new UsersGetViewModel($user);
        }

        $this->body = ['users' => $users];

        return $this;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json", params="users.json")
     * @Transactional()
     * @Purge(uri="app://self/users")
     * @Link(rel="detail", href="/users/{id}")
     */
    public function onPost(
        string $username,
        string $email
    ): ResourceObject {
        $createResponse = $this->userCreateUseCase->handle(
            new UserCreateInputData(
                $username,
                $email
            )
        );

        $this->body['id'] = $createResponse->getId();

        $this->code = StatusCode::CREATED;
        $this->headers[ResponseHeader::LOCATION] = '/users/' . $createResponse->getId();

        return $this;
    }
}
