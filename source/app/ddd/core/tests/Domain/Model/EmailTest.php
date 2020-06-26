<?php
declare(strict_types=1);
namespace AppCoreTest\Domain\Model;

use AppCore\Domain\Model\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function testEmail() : void
    {
        $email = new Email('bear@example.com');
        $this->assertSame('bear@example.com', $email->val());
    }
}
