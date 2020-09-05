<?php

declare(strict_types=1);

namespace AppCore\Application\User\Delete;

use AppCore\Domain\User\UserRepositoryInterface;

class UserDeleteUseCase
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
