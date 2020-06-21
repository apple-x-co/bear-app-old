<?php
declare(strict_types=1);
namespace AppCore\Application\User;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\Exception\UserDuplicationException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
use AppCore\Domain\Service\UserService;
use Generator;

// LCOM（Lack of Cohesion in Methods）の観点で、凝縮度を高くするために
// UserRegisterService, UserDeleteService, UserUpdateService に分けることも可。
// その場合は、UserRegisterServiceInterface->handle などのインターフェースを用意する。
// ※ ドメイン駆動設計入門 位置 2477

final class UserApplicationService
{
    /** @var UserQueryInterface */
    private $userQuery;

    /** @var UserService */
    private $userService;

    /** @var UserQueryServiceInterface */
    private $userQueryService;

    /**
     * UserApplicationService constructor.
     *
     * @param UserQueryInterface        $userQuery
     * @param UserService               $userService
     * @param UserQueryServiceInterface $userQueryService
     */
    public function __construct(
        UserQueryInterface $userQuery,
        UserService $userService,
        UserQueryServiceInterface $userQueryService
    ) {
        $this->userQuery = $userQuery;
        $this->userService = $userService;
        $this->userQueryService = $userQueryService;
    }

    /**
     * @return Generator
     *
     * 参照毎にメソッド・オブジェクトに分ける
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
