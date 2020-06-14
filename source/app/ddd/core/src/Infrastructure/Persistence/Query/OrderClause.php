<?php
declare(strict_types=1);
namespace AppCore\Infrastructure\Persistence\Query;

use AppCore\Infrastructure\OrderBy;
use Aura\SqlQuery\Common\SelectInterface;

final class OrderClause
{
    /** @var array */
    private $options;

    /** @var array */
    private $aliases;

    /**
     * OrderClause constructor.
     *
     * @param array $options
     * @param array $aliases
     */
    public function __construct(array $options, array $aliases = [])
    {
        $this->options = $options;
        $this->aliases = $aliases;
    }

    /**
     * @param SelectInterface $order
     *
     * @return SelectInterface
     */
    public function __invoke(SelectInterface $order) : SelectInterface
    {
        if (isset($this->options['order'])) {
            $order_by = [];
            foreach ($this->options['order'] as $orderBy) {
                /** @var OrderBy $orderBy */
                $column_name = $orderBy->getColumnName();

                if (isset($this->aliases[$column_name])) {
                    $column_name = $this->aliases[$column_name];
                }

                $order_by[] = sprintf('%s %s', $column_name, $orderBy->isAsc() ? 'ASC' : 'DESC');
            }
            $order->orderBy($order_by);
        }

        return $order;
    }
}
