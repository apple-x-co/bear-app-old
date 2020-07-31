<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use App\ViewModel\UsersGetViewModel;
use AppCore\UseCase\User\Create\UserCreateInputData;
use AppCore\UseCase\User\Create\UserCreateUseCaseInterface;
use AppCore\UseCase\User\Get\UserListUseCaseInterface;
use BEAR\RepositoryModule\Annotation\Purge;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\Annotation\Link;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Ray\AuraSqlModule\Annotation\Transactional;

class Users extends ResourceObject
{
    /** @var UserCreateUseCaseInterface */
    private $userCreateUseCase;

    /** @var UserListUseCaseInterface */
    private $userListUseCase;

    /**
     * Users constructor.
     *
     * @param UserCreateUseCaseInterface $userCreateUseCase
     * @param UserListUseCaseInterface   $userListUseCase
     */
    public function __construct(
        UserCreateUseCaseInterface $userCreateUseCase,
        UserListUseCaseInterface $userListUseCase
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
            $users[] = new UsersGetViewModel(
                $user->getId(),
                $user->getUserName(),
                $user->getEmail()
            );
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
