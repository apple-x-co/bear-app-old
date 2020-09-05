<?php

declare(strict_types=1);

namespace AppCore\Application\User\Get;

use AppCore\Domain\User\UserRepositoryInterface;

class UserGetUseCase
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserGetUseCase constructor.
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
    public function handle(UserGetInputData $input): UserGetOutputData
    {
        $user = $this->userRepository->get($input->getId());

        return new UserGetOutputData($user);
    }
}
