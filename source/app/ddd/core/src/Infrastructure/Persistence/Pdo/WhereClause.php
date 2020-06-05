<?php declare(strict_types=1);


namespace AppCore\Infrastructure\Persistence\Pdo;


use Aura\SqlQuery\Common\WhereInterface;

final class WhereClause
{
    /** @var string */
    public const OPERATION_IN = ':in';

    /** @var string */
    public const OPERATION_NE = ':not';

    /** @var string */
    public const OPERATION_LIKE = ':like';

    /** @var string */
    public const OPERATION_GT = ':gt'; // >

    /** @var string */
    public const OPERATION_LT = ':lt'; // <

    /** @var array */
    private $conditions;

    /** @var array */
    private $aliases;

    /**
     * WhereClause constructor.
     *
     * @param array $conditions
     * @param array $aliases
     */
    public function __construct(array $conditions, array $aliases = [])
    {
        $this->conditions = $conditions;
        $this->aliases    = $aliases;
    }

    /**
     * @param WhereInterface $where
     *
     * @return mixed
     */
    public function __invoke(WhereInterface $where)
    {
        foreach ($this->conditions as $column_name => $value) {
            [$operator, $column] = $this->splitColumnOperator($column_name);

            if (isset($this->aliases[$column])) {
                $column = $this->aliases[$column];
            }

            if (is_array($value) && empty($value) && $operator === 'IN') {
                continue;
            }
            if ($value === null && $operator === '=') {
                $where->where(sprintf('%s IS NULL', $column));
                continue;
            }
            if ($value === null && $operator === '!=') {
                $where->where(sprintf('%s IS NOT NULL', $column));
                continue;
            }

            if ($operator === 'LIKE') {
                $value = '%' . str_replace('%', '\%', $value) . '%';
                $where->where(sql_stmt_format($column, $operator, $value), $value);
                continue;
            }

            if ($operator === '=' && $value instanceof \DateTimeImmutable) {
                $where->where(
                    $column . ' BETWEEN ? AND ?',
                    $value->setTime(0, 0, 0, 0)->format('Y-m-d H:i:s'),
                    $value->setTime(23, 59, 59, 999999)->format('Y-m-d H:i:s')
                );
                continue;
            }

            if (is_object($value) && $value instanceof \DateTimeImmutable) {
                $value = $value->format('Y-m-d H:i:s');
            }
            $where->where(sql_stmt_format($column, $operator, $value), $value);
        }

        return $where;
    }

    /**
     * @param string $column_name
     *
     * @return array
     */
    private function splitColumnOperator(string $column_name): array
    {
        if (substr($column_name, -3) === self::OPERATION_IN) {
            return ['IN', substr($column_name, 0, strpos($column_name, self::OPERATION_IN))];
        }
        if (substr($column_name, -4) === self::OPERATION_NE) {
            return ['!=', substr($column_name, 0, strpos($column_name, self::OPERATION_NE))];
        }
        if (substr($column_name, -5) === self::OPERATION_LIKE) {
            return ['LIKE', substr($column_name, 0, strpos($column_name, self::OPERATION_LIKE))];
        }
        if (substr($column_name, -3) === self::OPERATION_GT) {
            return ['>', substr($column_name, 0, strpos($column_name, self::OPERATION_GT))];
        }
        if (substr($column_name, -3) === self::OPERATION_LT) {
            return ['<', substr($column_name, 0, strpos($column_name, self::OPERATION_LT))];
        }

        return ['=', $column_name];
    }
}