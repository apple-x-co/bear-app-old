<?php

declare(strict_types=1);

namespace AppCore\Domain\Application\User;

use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\UseCase\User\Delete\UserDeleteInputData;
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
    public function handle(UserDeleteInputData $input): void
    {
        $user = $this->userRepository->get($input->getId());

        $this->userRepository->delete($user->getId()->val());
    }
}
