<?php
declare(strict_types=1);
namespace AppCoreTest\Domain\Model\User;

use AppCore\Domain\User\UserName;
use PHPUnit\Framework\TestCase;

final class UserNameTest extends TestCase
{
    public function testUserName() : void
    {
        $userName = new UserName('bear');
        $this->assertSame('bear', $userName->val());
    }
}
