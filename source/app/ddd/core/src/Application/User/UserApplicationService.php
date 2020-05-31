<?php declare(strict_types=1);


namespace AppCore\Application\User;


use AppCore\Domain\Model\User\Exception\UserDuplicationException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserService;

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
     * @param UserService $userService
     */
    public function __construct(UserRepositoryInterface $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService    = $userService;
    }

    /**
     * @param UserCreateCommand $command
     */
    public function create(UserCreateCommand $command): void
    {
        $user = new User(null, $command->getUserName(), $command->getEmail());

        if ($this->userService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', (string)$user->getEmail()));
        }

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