<?php
declare(strict_types=1);
namespace AppCore\Domain\User\Exception;

use AppCore\Exception\RuntimeException;

final class UserNotFoundException extends RuntimeException
{
}
