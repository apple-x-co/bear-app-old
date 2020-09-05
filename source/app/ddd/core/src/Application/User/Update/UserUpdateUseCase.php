<?php

declare(strict_types=1);

namespace AppCore\Application\User\Update;

use AppCore\Domain\Shared\Email;
use AppCore\Domain\User\Exception\UserDuplicationException;
use AppCore\Domain\User\UserDomainService;
use AppCore\Domain\User\UserName;
use AppCore\Domain\User\UserRepositoryInterface;

class UserUpdateUseCase
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserDomainService */
    private $userDomainService;

    /**
     * UserUpdateUseCase constructor.
     *
     * @param UserRepositoryInterface    $userRepository
     * @param UserDomainService $userDomainService
     */
    public function __construct(UserRepositoryInterface $userRepository, UserDomainService $userDomainService)
    {
        $this->userRepository = $userRepository;
        $this->userDomainService = $userDomainService;
    }

    /**
     * @inheritDoc
     */
    public function handle(UserUpdateInputData $input): void
    {
        $user = $this->userRepository->get($input->getId());

        if ($this->userDomainService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', (string)$user->getEmail()));
        }

        if ($input->getUserName() !== null) {
            $user->changeUserName(new UserName($input->getUserName()));
        }
        if ($input->getEmail() !== null) {
            $user->changeEmail(new Email($input->getEmail()));
        }

        $this->userRepository->store($user);
    }
}
