<?php

declare(strict_types=1);

namespace AppCore\Application\User;

use AppCore\Application\User\Assembler\UserAssembler;
use AppCore\Application\User\Command\UserCreateCommand;
use AppCore\Application\User\Command\UserDeleteCommand;
use AppCore\Application\User\Command\UserGetCommand;
use AppCore\Application\User\Command\UserUpdateCommand;
use AppCore\Application\User\Dto\UserData;
use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\Exception\UserDuplicationException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
use AppCore\Domain\Service\UserServiceInterface;
use Generator;

final class UserApplicationService
{
    /** @var UserQueryInterface */
    private $userQuery;

    /** @var UserServiceInterface */
    private $userService;

    /** @var UserQueryServiceInterface */
    private $userQueryService;

    /**
     * UserApplicationService constructor.
     *
     * @param UserQueryInterface        $userQuery
     * @param UserServiceInterface      $userService
     * @param UserQueryServiceInterface $userQueryService
     */
    public function __construct(
        UserQueryInterface $userQuery,
        UserServiceInterface $userService,
        UserQueryServiceInterface $userQueryService
    ) {
        $this->userQuery = $userQuery;
        $this->userService = $userService;
        $this->userQueryService = $userQueryService;
    }

    /**
     * @return Generator
     */
    public function list() : Generator
    {
        $generator = $this->userQueryService->list();

        foreach ($generator as $user) {
            yield $user;
        }
    }

    /**
     * @param UserGetCommand $command
     *
     * @return UserData
     */
    public function get(UserGetCommand $command) : UserData
    {
        $user = $this->userQuery->get($command->getId());

        return (new UserAssembler())->toDto($user);
    }

    /**
     * @param UserCreateCommand $command
     *
     * @return UserData
     */
    public function create(UserCreateCommand $command) : UserData
    {
        $user = new User(
            null,
            new UserName($command->getUserName()),
            new Email($command->getEmail())
        );

        if ($this->userService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', $command->getEmail()));
        }

        $user = $this->userQuery->store($user);

        return (new UserAssembler())->toDto($user);
    }

    /**
     * @param UserUpdateCommand $command
     */
    public function update(UserUpdateCommand $command) : void
    {
        $user = $this->userQuery->get($command->getId());

        if ($this->userService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', (string) $user->getEmail()));
        }

        if ($command->getUserName() !== null) {
            $user->changeUserName(new UserName($command->getUserName()));
        }
        if ($command->getEmail() !== null) {
            $user->changeEmail(new Email($command->getEmail()));
        }

        $this->userQuery->store($user);
    }

    /**
     * @param UserDeleteCommand $command
     */
    public function delete(UserDeleteCommand $command) : void
    {
        $user = $this->userQuery->get($command->getId());

        $this->userQuery->delete($user->getId()->val());
    }
}
