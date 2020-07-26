<?php

declare(strict_types=1);

namespace AppCore\Application\User\Command;

final class UserGetCommand
{
    private $id;

    /**
     * UserGetCommand constructor.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
