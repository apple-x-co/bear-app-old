<?php

declare(strict_types=1);

namespace AppCore\Infrastructure\Persistence;

use AppCore\Infrastructure\Persistence\RDB\WhereClause;
use Ray\AuraSqlModule\AuraSqlInject;
use Ray\AuraSqlModule\AuraSqlSelectInject;
use Ray\Query\QueryInterface;

final class UsersCounter implements QueryInterface
{
    use AuraSqlInject;
    use AuraSqlSelectInject;

    /**
     * {@inheritdoc}
     */
    public function __invoke(array ...$query)
    {
        [$conditions] = $query;

        $select = clone $this->select;

        $select
            ->cols([
                'COUNT(id) as count'
            ])
            ->from('users');

        $select = (new WhereClause($conditions))($select);

        return (int) ($this->pdo->fetchValue($select->getStatement(), $select->getBindValues()));
    }
}
