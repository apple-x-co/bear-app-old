<?php
declare(strict_types=1);
namespace AppCoreTest\Infrastructure\Persistence\Query;

use AppCore\Domain\Model\User\UserQueryInterface;
use AppCore\Infrastructure\Persistence\Query\UserQuery;
use Aura\Sql\ExtendedPdo;
use PHPUnit\Framework\TestCase;
use Ray\Query\RowInterface;
use Ray\Query\RowListInterface;
use Ray\Query\SqlQueryRow;
use Ray\Query\SqlQueryRowList;

final class UserQueryTest extends TestCase
{
    /** @var UserQueryInterface */
    private $userQuery;

    public function setUp() : void
    {
        $pdo = new ExtendedPdo('sqlite::memory');

        /** @var RowListInterface $rows */
        $rows = new SqlQueryRowList($pdo, '');

        /** @var RowInterface $row */
        $row = new SqlQueryRow($pdo, '');

        $this->userQuery = new UserQuery(
            $pdo,
            static function (array $array) {
            },
            static function (array $array) {
            },
            $rows,
            static function (array $array) {
            },
            static function (array $array) {
            },
            $row,
            static function (array $array) {
            }
        );
    }

    public function testCreateUser() : void
    {
    }
}
