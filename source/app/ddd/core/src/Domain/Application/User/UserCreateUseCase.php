<?php

declare(strict_types=1);

namespace AppCore\Domain\Application\User;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\Exception\UserDuplicationException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserServiceInterface;
use AppCore\UseCase\User\Create\UserCreateRequest;
use AppCore\UseCase\User\Create\UserCreateResponse;
use AppCore\UseCase\User\Create\UserCreateUseCaseInterface;

class UserCreateUseCase implements UserCreateUseCaseInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserServiceInterface */
    private $userService;

    /**
     * UserCreateUseCase constructor.
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
    public function handle(UserCreateRequest $request): UserCreateResponse
    {
        $user = new User(
            null,
            new UserName($request->getUserName()),
            new Email($request->getEmail())
        );

        if ($this->userService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', $request->getEmail()));
        }

        $user = $this->userRepository->store($user);

        return new UserCreateResponse($user);
    }
}
