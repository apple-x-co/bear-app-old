<?php
declare(strict_types=1);
namespace AppCore\Infrastructure;

final class OrderBy
{
    public const ASC = 'asc';

    public const DESC = 'desc';

    /** @var string */
    private $column_name;

    /** @var string */
    private $direction;

    /**
     * OrderBy constructor.
     *
     * @param string $column_name
     * @param string $direction
     */
    public function __construct(string $column_name, string $direction = self::ASC)
    {
        $this->column_name = $column_name;
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function getColumnName() : string
    {
        return $this->column_name;
    }

    /**
     * @return bool
     */
    public function isAsc() : bool
    {
        return strtolower($this->direction) === self::ASC;
    }
}
