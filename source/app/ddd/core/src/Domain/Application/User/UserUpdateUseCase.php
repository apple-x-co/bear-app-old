<?php

declare(strict_types=1);

namespace AppCore\Domain\Application\User;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\Exception\UserDuplicationException;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserServiceInterface;
use AppCore\UseCase\User\Update\UserUpdateRequest;
use AppCore\UseCase\User\Update\UserUpdateUseCaseInterface;

class UserUpdateUseCase implements UserUpdateUseCaseInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserServiceInterface */
    private $userService;


    /**
     * UserUpdateUseCase constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param UserServiceInterface    $userService
     */
    public function __construct(UserRepositoryInterface $userRepository, UserServiceInterface $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * @inheritDoc
     */
    public function handle(UserUpdateRequest $request): void
    {
        $user = $this->userRepository->get($request->getId());

        if ($this->userService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', (string) $user->getEmail()));
        }

        if ($request->getUserName() !== null) {
            $user->changeUserName(new UserName($request->getUserName()));
        }
        if ($request->getEmail() !== null) {
            $user->changeEmail(new Email($request->getEmail()));
        }

        $this->userRepository->store($user);
    }
}
