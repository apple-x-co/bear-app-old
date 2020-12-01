<?php

declare(strict_types=1);

namespace AppCore\Domain\Model\User;

use AppCore\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserIdTest extends TestCase
{
    public function testUserId(): void
    {
        $userId = new UserId(1);
        self::assertSame(1, $userId->val());
    }
}
