<?php
declare(strict_types=1);
namespace AppCoreTest\Domain\Model\User;

use AppCore\Domain\Shared\Email;
use AppCore\Domain\User\User;
use AppCore\Domain\User\UserId;
use AppCore\Domain\User\UserName;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testNewUser() : void
    {
        $user = new User(
            new UserName('bear'),
            new Email('bear@example.com')
        );
        self::assertSame('bear', $user->getUserName()->val());
        self::assertSame('bear@example.com', $user->getEmail()->val());
    }

    public function testExistsUser() : void
    {
        $user = User::reconstruct(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );
        self::assertSame(1, $user->getId()->val());
        self::assertSame('bear', $user->getUserName()->val());
        self::assertSame('bear@example.com', $user->getEmail()->val());
    }

    public function testChangeName() : void
    {
        $user = User::reconstruct(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );

        $user->changeUserName(new UserName('BEAR'));
        self::assertSame('BEAR', $user->getUserName()->val());
    }

    public function testChangeEmail() : void
    {
        $user = User::reconstruct(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );

        $user->changeEmail(new Email('bear.sunday@example.com'));
        self::assertSame('bear.sunday@example.com', $user->getEmail()->val());
    }
}
