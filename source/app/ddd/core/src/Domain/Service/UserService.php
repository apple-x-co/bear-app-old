<?php declare(strict_types=1);


namespace AppCore\Domain\Service;


use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserRepositoryInterface;

// 可能な限りドメインサービスのは避ける
// エンティティや値ブジェクトに定義できるものであれば、そこに定義する

final class UserService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function exists(User $user): bool
    {
        $users = $this->userRepository->find([
            'email' => $user->getEmail()->val()
        ]);

        return ! empty($users);
    }
}