<?php declare(strict_types=1);


namespace AppCore\Domain\Model\User;


use AppCore\Exception\RuntimeException;

final class UserName
{
    private $value;

    /**
     * UserName constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        if (strlen($value) < 3) {
            throw new RuntimeException('');
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function val(): string
    {
        return $this->value;
    }
}