<?php declare(strict_types=1);


namespace AppCore\Application\User;


use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserRepositoryInterface;

final class UserService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserCreateCommand $command
     */
    public function create(UserCreateCommand $command): void
    {
        $user = new User(null, $command->getUserName());
        $this->userRepository->store($user);
    }

    /**
     * @param UserGetCommand $command
     *
     * @return UserData
     */
    public function get(UserGetCommand $command): UserData
    {
        $user = $this->userRepository->get(0);

        return (new UserAssembler())->toDto($user);
    }
}