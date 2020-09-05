<?php

declare(strict_types=1);

namespace AppCore\Application\User\Get;

final class UserGetInputData
{
    private $id;

    /**
     * UserGetInputData constructor.
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
