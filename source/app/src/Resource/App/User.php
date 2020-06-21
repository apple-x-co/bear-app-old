<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Resource\App;

use AppCore\Application\User\UserApplicationService;
use AppCore\Application\User\UserDeleteCommand;
use AppCore\Application\User\UserGetCommand;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;

/**
 * Class User
 */
class User extends ResourceObject
{
    /** @var UserApplicationService */
    private $userApplicationService;

    /**
     * User constructor.
     *
     * @param UserApplicationService $userApplicationService
     */
    public function __construct(UserApplicationService $userApplicationService)
    {
        $this->userApplicationService = $userApplicationService;
    }

    /**
     * @param int $id
     *
     * @return $this|ResourceObject
     *
     * @JsonSchema(schema="user.json")
     */
    public function onGet(int $id) : ResourceObject
    {
        $user = $this->userApplicationService->get(
            new UserGetCommand($id)
        );

        $this->body = [
            'id' => $user->getId(),
            'username' => $user->getUserName(),
            'email' => $user->getEmail()
        ];

        return $this;
    }

    /**
     * @param int $id
     *
     * @return ResourceObject
     */
    public function onDelete(int $id) : ResourceObject
    {
        $this->userApplicationService->delete(
            new UserDeleteCommand($id)
        );

        return $this;
    }
}
