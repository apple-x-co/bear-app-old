<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

final class UserId
{
    private $value;

    /**
     * UserId constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function val() : int
    {
        return $this->value;
    }
}
