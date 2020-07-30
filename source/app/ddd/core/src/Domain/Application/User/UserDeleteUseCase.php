<?php

declare(strict_types=1);

namespace AppCore\Domain\Application\User;

use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\UseCase\User\Delete\UserDeleteRequest;
use AppCore\UseCase\User\Delete\UserDeleteUseCaseInterface;

class UserDeleteUseCase implements UserDeleteUseCaseInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserDeleteUseCase constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function handle(UserDeleteRequest $request): void
    {
        $user = $this->userRepository->get($request->getId());

        $this->userRepository->delete($user->getId()->val());
    }
}
