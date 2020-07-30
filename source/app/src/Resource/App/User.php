<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use AppCore\UseCase\User\Delete\UserDeleteRequest;
use AppCore\UseCase\User\Delete\UserDeleteUseCaseInterface;
use AppCore\UseCase\User\Get\UserGetRequest;
use AppCore\UseCase\User\Get\UserGetUseCaseInterface;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\Annotation\Link;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\StatusCode;

class User extends ResourceObject
{
    /** @var UserGetUseCaseInterface */
    private $userGetUseCase;

    /** @var UserDeleteUseCaseInterface */
    private $userDeleteUseCase;

    /**
     * User constructor.
     *
     * @param UserGetUseCaseInterface    $userGetUseCase
     * @param UserDeleteUseCaseInterface $userDeleteUseCase
     */
    public function __construct(UserGetUseCaseInterface $userGetUseCase, UserDeleteUseCaseInterface $userDeleteUseCase)
    {
        $this->userGetUseCase = $userGetUseCase;
        $this->userDeleteUseCase = $userDeleteUseCase;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json")
     * @Link(rel="delete", href="/users/{id}", method="delete")
     */
    public function onGet(int $id): ResourceObject
    {
        $user = $this->userGetUseCase->handle(
            new UserGetRequest($id)
        );

        $this->body = [
            'id' => $user->getId(),
            'username' => $user->getUserName(),
            'email' => $user->getEmail(),
        ];

        return $this;
    }

    public function onDelete(int $id): ResourceObject
    {
        $this->userDeleteUseCase->handle(
            new UserDeleteRequest($id)
        );

        $this->code = StatusCode::NO_CONTENT;

        return $this;
    }
}
