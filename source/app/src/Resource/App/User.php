<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\App;

use AppCore\Application\User\UserApplicationService;
use AppCore\Application\User\UserDeleteCommand;
use AppCore\Application\User\UserGetCommand;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\Annotation\Link;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\StatusCode;

class User extends ResourceObject
{
    /** @var UserApplicationService */
    private $userApplicationService;

    public function __construct(UserApplicationService $userApplicationService)
    {
        $this->userApplicationService = $userApplicationService;
    }

    /**
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json")
     * @Link(rel="delete", href="/users/{id}", method="delete")
     */
    public function onGet(int $id): ResourceObject
    {
        $user = $this->userApplicationService->get(
            new UserGetCommand($id)
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
        $this->userApplicationService->delete(
            new UserDeleteCommand($id)
        );

        $this->code = StatusCode::NO_CONTENT;

        return $this;
    }
}
