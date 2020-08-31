<?php

declare(strict_types=1);

namespace AppCore\Application\User\Create;

use AppCore\Domain\Shared\Email;
use AppCore\Domain\User\Exception\UserDuplicationException;
use AppCore\Domain\User\User;
use AppCore\Domain\User\UserDomainService;
use AppCore\Domain\User\UserName;
use AppCore\Domain\User\UserRepositoryInterface;

class UserCreateUseCase
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserDomainService */
    private $userDomainService;

    /**
     * UserCreateUseCase constructor.
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
    public function handle(UserCreateInputData $input): UserCreateOutputData
    {
        $user = new User(
            new UserName($input->getUserName()),
            new Email($input->getEmail())
        );

        if ($this->userDomainService->exists($user)) {
            throw new UserDuplicationException(sprintf('email : %s', $input->getEmail()));
        }

        $user = $this->userRepository->store($user);

        return new UserCreateOutputData($user);
    }
}
