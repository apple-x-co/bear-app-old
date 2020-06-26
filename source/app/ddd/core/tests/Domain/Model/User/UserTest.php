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
        $this->assertEquals('bear', $user->getUserName()->val());
        $this->assertEquals('bear@example.com', $user->getEmail()->val());
    }

    public function testExistsUser() : void
    {
        $user = new User(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );
        $this->assertEquals(1, $user->getId()->val());
        $this->assertEquals('bear', $user->getUserName()->val());
        $this->assertEquals('bear@example.com', $user->getEmail()->val());
    }

    public function testChangeName() : void
    {
        $user = new User(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );

        $user->changeUserName(new UserName('BEAR'));
        $this->assertEquals('BEAR', $user->getUserName()->val());
    }

    public function testChangeEmail() : void
    {
        $user = new User(
            new UserId(1),
            new UserName('bear'),
            new Email('bear@example.com')
        );

        $user->changeEmail(new Email('bear.sunday@example.com'));
        $this->assertEquals('bear.sunday@example.com', $user->getEmail()->val());
    }
}
