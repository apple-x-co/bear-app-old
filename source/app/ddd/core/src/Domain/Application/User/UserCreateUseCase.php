<?php

declare(strict_types=1);

namespace AppCore\Domain\Application\User;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\Exception\UserDuplicationException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserDomainServiceInterface;
use AppCore\UseCase\User\Create\UserCreateInputData;
use AppCore\UseCase\User\Create\UserCreateOutputData;
use AppCore\UseCase\User\Create\UserCreateUseCaseInterface;

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
            null,
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
