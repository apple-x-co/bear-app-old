<?php
declare(strict_types=1);
namespace AppCore\Infrastructure\Persistence\Query;

use AppCore\Application\User\Assembler\UserAssembler;
use AppCore\Application\User\UserQueryServiceInterface;
use AppCore\Domain\Model\User\UserQueryInterface;
use Generator;

final class UserQueryService implements UserQueryServiceInterface
{
    /** @var UserQueryInterface */
    private $userQuery;

    /**
     * UserQueryService constructor.
     *
     * @param UserQueryInterface $userQuery
     */
    public function __construct(UserQueryInterface $userQuery)
    {
        $this->userQuery = $userQuery;
    }

    /**
     * {@inheritdoc}
     */
    public function list() : Generator
    {
        $generator = $this->userQuery->find();

        foreach ($generator as $user) {
            yield (new UserAssembler())->toDto($user);
        }
    }
}
