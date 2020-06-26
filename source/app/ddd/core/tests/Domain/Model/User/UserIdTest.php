<?php
declare(strict_types=1);
namespace AppCoreTest\Domain\Model\User;

use AppCore\Domain\Model\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserIdTest extends TestCase
{
    public function testUserId() : void
    {
        $userId = new UserId(1);
        $this->assertSame(1, $userId->val());
    }
}
