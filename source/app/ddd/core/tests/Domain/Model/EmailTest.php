<?php

declare(strict_types=1);

namespace AppCore\Domain\Model;

use AppCore\Domain\Shared\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testEmail(): void
    {
        $email = new Email('bear@example.com');
        self::assertSame('bear@example.com', $email->val());
    }
}
