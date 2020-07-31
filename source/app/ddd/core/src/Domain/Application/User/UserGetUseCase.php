<?php

declare(strict_types=1);

namespace AppCore\Domain\Application\User;

use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\UseCase\User\Get\UserGetInputData;
use AppCore\UseCase\User\Get\UserGetOutputData;
use AppCore\UseCase\User\Get\UserGetUseCaseInterface;

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
