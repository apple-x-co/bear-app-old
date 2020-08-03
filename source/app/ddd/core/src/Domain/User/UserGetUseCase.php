<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

use AppCore\Application\User\Get\UserGetInputData;
use AppCore\Application\User\Get\UserGetOutputData;
use AppCore\Application\User\Get\UserGetUseCaseInterface;

class UserGetUseCase implements UserGetUseCaseInterface
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
