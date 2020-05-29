<?php declare(strict_types=1);


namespace AppCore\Domain\Model\User;


final class UserName
{
    private $name;

    /**
     * UserName constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }
}