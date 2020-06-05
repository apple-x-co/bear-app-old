<?php declare(strict_types=1);


namespace AppCore\Domain\Model;


final class Email
{
    private $value;

    /**
     * Email constructor.
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