<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

use AppCore\Application\User\Get\UserListOutputData;
use AppCore\Application\User\Get\UserListUseCaseInterface;
use Generator;

class UserListUseCase implements UserListUseCaseInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserListUseCase constructor.
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
    public function handle(): Generator
    {
        $generator = $this->userRepository->find();

        foreach ($generator as $user) {
            yield new UserListOutputData($user);
        }
    }
}
