<?php declare(strict_types=1);


namespace AppCore\Infrastructure\Persistence\Pdo;


use Aura\SqlQuery\Common\SelectInterface;

final class LimitOffsetClause
{
    /** @var array */
    private $options;

    /**
     * LimitOffsetClause constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param SelectInterface $limitOffset
     *
     * @return SelectInterface
     */
    public function __invoke(SelectInterface $limitOffset): SelectInterface
    {
        if (isset($this->options['offset'])) {
            $limitOffset->offset($this->options['offset']);
        }
        if (isset($this->options['limit'])) {
            $limitOffset->limit($this->options['limit']);
        }

        return $limitOffset;
    }
}