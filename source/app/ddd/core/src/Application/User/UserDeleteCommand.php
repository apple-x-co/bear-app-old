<?php
declare(strict_types=1);
namespace AppCore\Application\User;

final class UserDeleteCommand
{
    /** @var int */
    private $id;

    /**
     * UserDeleteCommand constructor.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }
}
