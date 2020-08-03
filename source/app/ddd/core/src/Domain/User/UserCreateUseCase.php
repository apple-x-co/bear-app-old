<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

use AppCore\Application\User\Create\UserCreateInputData;
use AppCore\Application\User\Create\UserCreateOutputData;
use AppCore\Application\User\Create\UserCreateUseCaseInterface;
use AppCore\Domain\Shared\Email;
use AppCore\Domain\User\Exception\UserDuplicationException;

class UserCreateUseCase implements UserCreateUseCaseInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserDomainServiceInterface */
    private $userDomainService;

    /**
     * UserCreateUseCase constructor.
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
