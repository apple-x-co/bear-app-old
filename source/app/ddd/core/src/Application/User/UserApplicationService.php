<?php
declare(strict_types=1);
namespace AppCore\Application\User;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\Exception\UserDuplicationException;
use AppCore\Domain\Model\User\Exception\UserNotFoundException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserService;

// LCOM（Lack of Cohesion in Methods）の観点で、凝縮度を高くするために
// UserRegisterService, UserDeleteService, UserUpdateService に分けることも可。
// その場合は、UserRegisterServiceInterface->handle などのインターフェースを用意する。
// ※ ドメイン駆動設計入門 位置 2477

final class UserApplicationService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserService */
    private $userService;

    /**
     * UserApplicationService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param UserService             $userService
     */
    public function __construct(UserRepositoryInterface $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * @param UserGetCommand $command
     *
     * @return UserData
     */
    public function get(UserGetCommand $command) : UserData
    {
        $user = $this->userRepository->get($command->getId());

        return (new UserAssembler())->toDto($user);
    }

    /**
     * @param UserCreateCommand $command
     */
    public function create(UserCreateCommand $command) : void
    {
        $user = new User(
            null,
            new UserName($command->getUserName()),
            new Email($command->getEmail())
        );

        if ($this->userService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', (string) $user->getEmail()));
        }

        $this->userRepository->store($user);
    }

    /**
     * @param UserUpdateCommand $command
     */
    public function update(UserUpdateCommand $command) : void
    {
        $user = $this->userRepository->one([
            'id' => $command->getId()
        ]);
        if ($user === null) {
            throw new UserNotFoundException(sprintf('id : %d', $command->getId()));
        }

        if ($this->userService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', (string) $user->getEmail()));
        }

        if ($command->getUserName() !== null) {
            $user->changeUserName(new UserName($command->getUserName()));
        }
        if ($command->getEmail() !== null) {
            $user->changeEmail(new Email($command->getEmail()));
        }
    }

    /**
     * @param UserDeleteCommand $command
     */
    public function delete(UserDeleteCommand $command) : void
    {
        $user = $this->userRepository->one([
            'id' => $command->getId()
        ]);
        if ($user === null) {
            throw new UserNotFoundException(sprintf('id : %d', $command->getId()));
        }

        $this->userRepository->remove($user);
    }
}
