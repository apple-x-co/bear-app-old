<?php declare(strict_types=1);


namespace AppCore\Domain\Model\User;


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