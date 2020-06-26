<?php
declare(strict_types=1);
namespace AppCoreTest\Domain\Model\User;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserId;
use AppCore\Domain\Model\User\UserName;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testNewUser() : void
    {
        $user = new User(
            null,
            new UserName('bear'),
            new Email('bear@example.com')
        );
        $this->assertSame('bear', $user->getUserName()->val());
        $this->assertSame('bear@example.com', $user->getEmail()->val());
    }

    public function testExistsUser() : void
    {
        $user = new User(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );
        $this->assertSame(1, $user->getId()->val());
        $this->assertSame('bear', $user->getUserName()->val());
        $this->assertSame('bear@example.com', $user->getEmail()->val());
    }

    public function testChangeName() : void
    {
        $user = new User(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );

        $user->changeUserName(new UserName('BEAR'));
        $this->assertSame('BEAR', $user->getUserName()->val());
    }

    public function testChangeEmail() : void
    {
        $user = new User(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );

        $user->changeEmail(new Email('bear.sunday@example.com'));
        $this->assertSame('bear.sunday@example.com', $user->getEmail()->val());
    }
}
