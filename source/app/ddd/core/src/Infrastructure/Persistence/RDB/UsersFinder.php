<?php

declare(strict_types=1);

namespace AppCore\Infrastructure\Persistence\RDB;

use Ray\AuraSqlModule\AuraSqlInject;
use Ray\AuraSqlModule\AuraSqlSelectInject;
use Ray\Query\QueryInterface;

final class UsersFinder implements QueryInterface
{
    use AuraSqlInject;
    use AuraSqlSelectInject;

    /**
     * {@inheritdoc}
     */
    public function __invoke(array ...$query)
    {
        [$conditions, $options] = $query;

        $select = clone $this->select;

        $select
            ->from('users')
            ->cols([
                'id',
                'username',
                'email',
                'created_at',
                'updated_at'
            ]);

        $select = (new WhereClause($conditions))($select);
        $select = (new OrderClause($options))($select);
        $select = (new LimitOffsetClause($options))($select);

        return $this->pdo->yieldAll($select->getStatement(), $select->getBindValues());
    }
}
