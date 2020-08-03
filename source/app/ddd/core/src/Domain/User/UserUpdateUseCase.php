<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

use AppCore\Application\User\Update\UserUpdateInputData;
use AppCore\Application\User\Update\UserUpdateUseCaseInterface;
use AppCore\Domain\Shared\Email;
use AppCore\Domain\User\Exception\UserDuplicationException;

class UserUpdateUseCase implements UserUpdateUseCaseInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserDomainServiceInterface */
    private $userDomainService;

    /**
     * UserUpdateUseCase constructor.
     *
     * @param UserRepositoryInterface    $userRepository
     * @param UserDomainServiceInterface $userDomainService
     */
    public function __construct(UserRepositoryInterface $userRepository, UserDomainServiceInterface $userDomainService)
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
